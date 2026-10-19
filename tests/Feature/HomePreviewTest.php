<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePreviewTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // Even database-backed session/cache configuration must not make this
        // stateless design route open a database connection.
        config(['session.driver' => 'database', 'cache.default' => 'database']);
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config)
            {
                throw new \RuntimeException('The home preview must not open a database connection.');
            }
        });
    }

    public function test_home_renders_real_content_without_a_database()
    {
        $this->get('/preview/home')
            ->assertStatus(200)
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('นางสาวคุณาพร บัวพันธ์')
            ->assertSee('name="q"')
            ->assertSee(route('preview.events'))
            ->assertSee(route('preview.events.show', ['event_uid' => '4557258015376265']))
            ->assertSee('lang="th"');
    }

    public function test_search_finds_old_documents_and_the_featured_story()
    {
        $this->get('/preview/home?q='.urlencode('ใบสมัคร'))
            ->assertStatus(200)
            ->assertSee('id="search-results"')
            ->assertViewHas('results', function ($results) {
                return in_array('7763027791698328', array_column($results, 'id'), true);
            });

        $this->get('/preview/home?q='.urlencode('คุณาพร บัวพันธ์'))
            ->assertStatus(200)
            ->assertSee('id="search-results"')
            ->assertViewHas('results', function ($results) {
                return in_array('4712334485356745', array_column($results, 'id'), true);
            });
    }

    public function test_search_handles_no_results_and_escapes_user_input()
    {
        $query = '<script>alert("sks-preview")</script>';
        $response = $this->get('/preview/home?q='.urlencode($query));
        $response->assertStatus(200)->assertSee('ยังไม่พบข้อมูลที่ตรงกับคำค้น');
        $this->assertStringNotContainsString($query, $response->getContent());
        $this->assertStringContainsString('&lt;script&gt;', $response->getContent());
    }

    public function test_search_pagination_preserves_query_and_bounds_page()
    {
        $response = $this->get('/preview/home?q='.urlencode('ศูนย์').'&page=99999');
        $response
            ->assertStatus(200)
            ->assertSee('aria-label="หน้าผลการค้นหา"')
            ->assertSee('ก่อนหน้า')
            ->assertViewHas('query', 'ศูนย์');
        $data = $response->original->getData();
        $this->assertSame($data['pages'], $data['page']);
        $this->assertLessThanOrEqual(12, count($data['results']));

        $this->get('/preview/home?q[]=invalid&page[]=invalid')->assertStatus(200);
    }

    public function test_news_detail_uses_snapshot_content_without_a_database()
    {
        $this->get('/preview/posts/4712334485356745')
            ->assertStatus(200)
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('id="article-title"')
            ->assertSee('บันทึกวันที่ 14 ตุลาคม 2569')
            ->assertViewHas('article', function ($article) {
                return $article['id'] === '4712334485356745'
                    && count($article['paragraphs']) === 1
                    && mb_strpos($article['paragraphs'][0], 'คณะกรรมการสถานศึกษา') !== false;
            })
            ->assertViewHas('related', function ($related) {
                return count($related) === 3
                    && !in_array('4712334485356745', array_column($related, 'id'), true);
            });
    }

    public function test_activity_detail_and_invalid_content_routes()
    {
        $this->get('/preview/events/4557258015376265')
            ->assertStatus(200)->assertSee('วันที่จัดกิจกรรม')->assertSee('11 ส.ค. 2569');
        $this->get('/preview/events/4712334485356745')->assertStatus(404);
        $this->get('/preview/posts/9999999999999999')->assertStatus(404);
        $this->get('/preview/services/4712334485356745')->assertStatus(404);
    }
}
