<?php

namespace Tests\Feature;

use App\Http\Controllers\ArticleController;
use App\Http\Helpers\HelperCore;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PostListingTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        config(['session.driver' => 'array', 'cache.default' => 'array']);
    }

    private function createTables()
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('category_name');
            $table->string('category_slug');
            $table->string('category_status');
        });
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('category_id');
            $table->string('sub_category_name');
            $table->string('sub_category_slug');
            $table->string('sub_category_status');
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('user_id')->nullable();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('post_title');
            $table->string('post_slug')->nullable();
            $table->string('post_image')->nullable();
            $table->text('post_detail')->nullable();
            $table->string('post_status');
            $table->timestamp('created_at')->nullable();
        });
        DB::table('categories')->insert([
            ['id' => 1, 'uid' => '6494479976512721', 'category_name' => 'ประชาสัมพันธ์', 'category_slug' => 'public-relations', 'category_status' => '1'],
            ['id' => 2, 'uid' => '7504392668518316', 'category_name' => 'รางวัลและผลงาน', 'category_slug' => 'awards', 'category_status' => '1'],
        ]);
        DB::table('sub_categories')->insert([
            ['id' => 10, 'uid' => '6953297868715565', 'category_id' => 1, 'sub_category_name' => 'ข่าวสาร', 'sub_category_slug' => 'news', 'sub_category_status' => '1'],
            ['id' => 11, 'uid' => '9092057552846650', 'category_id' => 1, 'sub_category_name' => 'กิจกรรมนักเรียน', 'sub_category_slug' => 'student-activities', 'sub_category_status' => '1'],
            ['id' => 12, 'uid' => '5727518316776390', 'category_id' => 2, 'sub_category_name' => 'ผลงานนักเรียน', 'sub_category_slug' => 'student-awards', 'sub_category_status' => '1'],
            ['id' => 13, 'uid' => 'inactive', 'category_id' => 1, 'sub_category_name' => 'ปิดใช้งาน', 'sub_category_slug' => 'inactive', 'sub_category_status' => '0'],
        ]);
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->andReturn(collect([
            ['uid' => '6494479976512721', 'category_name' => 'ประชาสัมพันธ์', 'sub_categories' => [
                ['uid' => '6953297868715565', 'sub_category_name' => 'ข่าวสาร'],
                ['uid' => '9092057552846650', 'sub_category_name' => 'กิจกรรมนักเรียน'],
            ]],
            ['uid' => '7504392668518316', 'category_name' => 'รางวัลและผลงาน', 'sub_categories' => []],
        ]));
        $helper->shouldReceive('recentPosts')->andReturn(collect());
        $helper->shouldReceive('popularPosts')->andReturn(collect());
        $helper->shouldReceive('getCategories')->andReturn(collect());
        $helper->shouldReceive('getSubCategories')->andReturn(collect());
        $controller = new ArticleController();
        $controller->helperCore = $helper;
        $this->app->instance(ArticleController::class, $controller);
    }

    public function test_category_and_subcategory_routes_filter_published_posts_and_preserve_search()
    {
        $this->createTables();
        DB::table('posts')->insert([
            ['uid' => '101', 'category_id' => 1, 'sub_category_id' => 10, 'post_title' => 'ข่าวใหม่', 'post_detail' => 'การเรียนรู้ร่วมกัน', 'post_status' => '1', 'created_at' => '2026-10-12'],
            ['uid' => '102', 'category_id' => 1, 'sub_category_id' => 11, 'post_title' => 'กิจกรรมนักเรียน', 'post_detail' => 'สนุกกับกิจกรรม', 'post_status' => '1', 'created_at' => '2026-10-10'],
            ['uid' => '103', 'category_id' => 1, 'sub_category_id' => 10, 'post_title' => 'ข่าวร่าง', 'post_detail' => 'ไม่เผยแพร่', 'post_status' => '0', 'created_at' => '2026-10-13'],
            ['uid' => '104', 'category_id' => 2, 'sub_category_id' => 12, 'post_title' => 'ผลงานเด่น', 'post_detail' => 'รางวัล', 'post_status' => '1', 'created_at' => '2026-10-11'],
        ]);
        $category = $this->get('/posts?category=6494479976512721');
        $category->assertStatus(200)->assertViewIs('frontend.article.index')
            ->assertSee('ข่าวใหม่')->assertSee('กิจกรรมนักเรียน')
            ->assertDontSee('ข่าวร่าง')->assertDontSee('ผลงานเด่น')
            ->assertSee('href="'.url('/posts/101').'"')
            ->assertSee('category=6494479976512721&amp;sub_category=6953297868715565')
            ->assertDontSee('noindex');
        $this->assertLessThan(strpos($category->getContent(), 'กิจกรรมนักเรียน</a></h3>'), strpos($category->getContent(), 'ข่าวใหม่</a></h3>'));

        $sub = $this->get('/posts?category=6494479976512721&sub_category=6953297868715565');
        $sub->assertStatus(200)->assertSee('<h1 id="post-list-title">ข่าวสาร</h1>')
            ->assertSee('ข่าวใหม่')->assertDontSee('กิจกรรมนักเรียน</a></h3>')
            ->assertSee('name="sub_category" value="6953297868715565"');
        $this->get('/posts?category=6494479976512721&sub_category=6953297868715565&name='.urlencode('การเรียนรู้'))
            ->assertStatus(200)->assertSee('ข่าวใหม่')->assertSee('ล้างคำค้นหา');
        $this->get('/posts?category=6494479976512721&sub_category=6953297868715565&name='.urlencode('ไม่พบ'))
            ->assertStatus(200)->assertSee('ไม่พบเรื่องที่ตรงกับคำค้นหา');
        $this->get('/posts?category=6494479976512721&sub_category=5727518316776390')->assertStatus(404);
        $this->get('/posts?category=6494479976512721&sub_category=inactive')->assertStatus(404);
    }

    public function test_previews_render_category_and_subcategory_without_database()
    {
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config) { throw new \RuntimeException('Preview must not query the database.'); }
        });
        $category = $this->get('/preview/posts?category=6494479976512721');
        $category->assertStatus(200)->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('ขอแสดงความยินดีกับนางสาวคุณาพร บัวพันธ์')
            ->assertSee('แสดงเมนูย่อยประชาสัมพันธ์')
            ->assertSee('href="'.route('preview.posts', ['category' => '7504392668518316']).'"');
        $this->get('/preview/posts?category=6494479976512721&sub_category=6953297868715565')
            ->assertStatus(200)->assertSee('<h1 id="post-list-title">ข่าวสาร</h1>')
            ->assertSee('href="'.route('preview.posts', ['category' => '6494479976512721']).'"');
        $this->get('/preview/posts?category=6494479976512721&sub_category=invalid')->assertStatus(404);
    }

    public function test_pagination_keeps_both_category_filters()
    {
        $this->createTables();
        $rows = [];
        for ($i = 1; $i <= 13; $i++) {
            $rows[] = [
                'uid' => (string) (200 + $i), 'category_id' => 1, 'sub_category_id' => 10,
                'post_title' => 'เรื่องที่ '.$i, 'post_detail' => 'ข่าวจากศูนย์',
                'post_status' => '1', 'created_at' => sprintf('2026-10-%02d', $i),
            ];
        }
        DB::table('posts')->insert($rows);
        $first = $this->get('/posts?category=6494479976512721&sub_category=6953297868715565');
        $first->assertStatus(200)->assertSee('category=6494479976512721&amp;sub_category=6953297868715565&amp;page=2#post-results');
        $second = $this->get('/posts?category=6494479976512721&sub_category=6953297868715565&page=2');
        $second->assertStatus(200)->assertSee('เรื่องที่ 1')->assertDontSee('เรื่องที่ 13</a></h3>');
    }

    public function test_legacy_subcategory_route_uses_its_category_and_search_query()
    {
        $this->createTables();
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->andReturn(collect());
        $helper->shouldReceive('recentPosts')->andReturn(collect());
        $helper->shouldReceive('popularPosts')->andReturn(collect());
        $helper->shouldReceive('getCategories')->andReturn(collect());
        $helper->shouldReceive('getSubCategories')->andReturn(collect());
        $controller = new ArticleController();
        $controller->helperCore = $helper;
        $this->app->instance(ArticleController::class, $controller);
        DB::table('posts')->insert([
            ['uid' => '101', 'category_id' => 1, 'sub_category_id' => 10, 'post_title' => 'ข่าวสำหรับค้นหา', 'post_detail' => 'รายละเอียด', 'post_status' => '1', 'created_at' => '2026-10-12'],
            ['uid' => '102', 'category_id' => 1, 'sub_category_id' => 11, 'post_title' => 'ข่าวหมวดอื่น', 'post_detail' => 'รายละเอียด', 'post_status' => '1', 'created_at' => '2026-10-11'],
        ]);

        $legacyBase = '/'.rawurlencode('หมวดหมู่').'/public-relations';
        $this->get($legacyBase.'/news?name='.urlencode('สำหรับค้นหา'))
            ->assertStatus(200)->assertSee('ข่าวสำหรับค้นหา')->assertDontSee('ข่าวหมวดอื่น');
        $this->get('/'.rawurlencode('หมวดหมู่').'/awards/news')->assertStatus(404);
        $this->get($legacyBase.'/inactive')->assertStatus(404);
    }
}
