<?php

namespace Tests\Feature;

use App\Http\Controllers\AboutController;
use App\Http\Helpers\HelperCore;
use Tests\TestCase;

class AboutPagesTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        config(['session.driver' => 'array', 'cache.default' => 'array']);
    }

    private function menuController($expectedCalls = 1)
    {
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->times($expectedCalls)->andReturn(collect([
            ['uid' => 'public-category', 'category_name' => 'หมวดจากฐานข้อมูล',
             'sub_categories' => [['uid' => 'public-subcategory', 'sub_category_name' => 'หมวดย่อยจากฐานข้อมูล']]],
        ]));
        $controller = new AboutController();
        $controller->helperCore = $helper;
        $this->app->instance(AboutController::class, $controller);
    }

    public function test_real_history_route_preserves_content_and_dynamic_menu()
    {
        $this->menuController();
        $response = $this->get('/about/history');
        $response->assertStatus(200)->assertViewIs('frontend.about.history')
            ->assertSee('หมวดจากฐานข้อมูล')->assertSee('หมวดย่อยจากฐานข้อมูล')
            ->assertSee('category=public-category&amp;sub_category=public-subcategory')
            ->assertSee('31 กรกฎาคม 2543')->assertSee('7 ไร่ 3 งาน 80 ตารางวา')
            ->assertDontSee('noindex')->assertDontSee('/preview/about/');
        $original = json_decode(file_get_contents(base_path('docs/about-redesign-2026-10-16/original-content.json')), true);
        foreach (array_merge($original['missions'], $original['responsibilities']) as $text) {
            $response->assertSee($text);
        }
        $this->assertStringContainsString('rel="canonical" href="'.url('/about/history').'"', $response->getContent());
    }

    public function test_real_executive_route_preserves_all_seven_names_roles_and_images()
    {
        $this->menuController();
        $response = $this->get('/about/executive');
        $response->assertStatus(200)->assertViewIs('frontend.about.executive')
            ->assertSee('หมวดจากฐานข้อมูล')->assertDontSee('noindex')->assertDontSee('/preview/about/');
        $original = json_decode(file_get_contents(base_path('docs/about-redesign-2026-10-16/original-content.json')), true);
        foreach ($original['leaders'] as $person) {
            $response->assertSee($person['name'])->assertSee($person['role'])->assertSee($person['image']);
        }
        $this->assertSame(1, substr_count($response->getContent(), 'class="director-card"'));
        $this->assertSame(6, substr_count($response->getContent(), 'class="person-card"'));
        $this->assertStringContainsString('rel="canonical" href="'.url('/about/executive').'"', $response->getContent());
    }

    public function test_real_contact_route_keeps_public_channels_and_uses_the_new_layout()
    {
        $this->menuController();
        config(['public.contact_email' => 'office@example.org', 'public.contact_phone' => '099-111-2222']);
        $response = $this->get('/contact');
        $response->assertStatus(200)->assertViewIs('frontend.about.contact')
            ->assertSee('หมวดจากฐานข้อมูล')
            ->assertSee('เลขที่ 400 หมู่ 1 ถนนถีนานนท์')
            ->assertSee('จังหวัดกาฬสินธุ์ 46120')
            ->assertSee('mailto:office@example.org')
            ->assertSee('href="tel:0991112222"')
            ->assertSee('images/home/present/sks-present-1.JPG')
            ->assertSee('google.com/maps/embed?pb=')
            ->assertSee('google.com/maps/dir/?api=1&amp;destination=16.4020688%2C103.3744296')
            ->assertSee('id="location"')
            ->assertDontSee('noindex')->assertDontSee('/preview/contact');
        $this->assertStringContainsString('rel="canonical" href="'.url('/contact').'"', $response->getContent());
    }

    public function test_local_previews_use_the_real_views_without_database_queries()
    {
        $this->menuController(0);
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config)
            {
                throw new \RuntimeException('About previews must not open a database connection.');
            }
        });
        foreach (['history', 'executive'] as $page) {
            $this->get('/preview/about/'.$page)->assertStatus(200)->assertViewIs('frontend.about.'.$page)
                ->assertHeader('X-Robots-Tag', 'noindex, nofollow')->assertHeader('Cache-Control', 'no-store, private');
        }
        $this->get('/preview/contact')->assertStatus(200)->assertViewIs('frontend.about.contact')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')->assertHeader('Cache-Control', 'no-store, private')
            ->assertSee('href="'.route('preview.home').'"')
            ->assertSee('google.com/maps/embed?pb=');
        $this->get('/preview/home?q='.urlencode('ผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์'))->assertStatus(200)
            ->assertViewHas('results', function ($results) {
                foreach ($results as $result) {
                    if ($result['id'] === 'executive') {
                        return $result['preview_url'] === route('preview.about', ['page' => 'executive']);
                    }
                }
                return false;
            });
        $this->get('/preview/about/unknown')->assertStatus(404);
    }
}
