<?php

namespace Tests\Feature;

use App\Http\Controllers\ArticleController;
use App\Http\Helpers\HelperCore;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PostDetailTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        config(['session.driver' => 'array', 'cache.default' => 'array']);
    }

    public function test_snapshot_detail_uses_the_public_design_without_database()
    {
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config) { throw new \RuntimeException('Preview must not query the database.'); }
        });

        $response = $this->get('/preview/article/5200260212700590');
        $response->assertStatus(200)->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertViewIs('frontend.article.show')
            ->assertSee('<h1 id="post-detail-title">เข้าร่วมการแข่งขัน')
            ->assertSee('ได้รับ รางวัลเหรียญทอง จำนวนทั้งสิ้น 16 รางวัล')
            ->assertSee('href="'.url('/preview/posts').'?category=6494479976512721&amp;sub_category=6953297868715565"')
            ->assertSee('href="'.url('/preview/article/4712334485356745').'"')
            ->assertSee('id="post-sidebar-recent-title"')->assertSee('id="post-sidebar-categories-title"')
            ->assertSee('id="post-sidebar-popular-title"')->assertSee('id="post-sidebar-topics-title"')
            ->assertSee('เข้าชม 82,451 ครั้ง')
            ->assertSee('href="'.url('/preview/article/2596715526463527').'"')
            ->assertDontSee('href="'.url('/article/'));
        $this->get('/preview/posts?category=6494479976512721')
            ->assertStatus(200)->assertSee('href="'.url('/preview/article/5200260212700590').'"');
        $this->get('/preview/article/9999999999999999')->assertStatus(404);
    }

    public function test_real_detail_preserves_cms_content_and_links_related_posts_by_uid()
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); $table->string('uid'); $table->string('category_name');
        });
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id'); $table->string('uid'); $table->string('sub_category_name');
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); $table->string('name');
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id'); $table->string('uid'); $table->integer('category_id');
            $table->integer('sub_category_id')->nullable(); $table->integer('user_id')->nullable();
            $table->string('post_title'); $table->string('post_image')->nullable();
            $table->string('post_image_thumbnail_file_name')->nullable();
            $table->text('post_detail')->nullable(); $table->longText('post_content')->nullable();
            $table->text('post_youtube_embed')->nullable(); $table->string('post_status');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id'); $table->morphs('viewable'); $table->text('visitor')->nullable();
            $table->string('collection')->nullable(); $table->timestamp('viewed_at')->nullable();
        });
        DB::table('categories')->insert(['id' => 1, 'uid' => '6494479976512721', 'category_name' => 'ประชาสัมพันธ์']);
        DB::table('sub_categories')->insert(['id' => 10, 'uid' => '6953297868715565', 'sub_category_name' => 'ข่าวสาร']);
        DB::table('users')->insert(['id' => 5, 'name' => 'งานประชาสัมพันธ์']);
        DB::table('posts')->insert(['uid' => '5200260212700590', 'category_id' => 1, 'sub_category_id' => 10, 'user_id' => 5, 'post_title' => 'ข่าวทดสอบ', 'post_detail' => 'เรื่องย่อ', 'post_content' => '<p>เนื้อหาจากระบบเดิม</p><a href="/documents/report.pdf">เอกสารแนบ</a>', 'post_status' => '1', 'created_at' => '2026-10-12']);
        DB::table('posts')->insert(['uid' => '234', 'category_id' => 1, 'sub_category_id' => 10, 'post_title' => 'ข่าวที่เกี่ยวข้อง', 'post_detail' => 'อ่านต่อ', 'post_status' => '1', 'created_at' => '2026-10-11']);
        DB::table('posts')->insert(['uid' => '235', 'category_id' => 1, 'sub_category_id' => 10, 'post_title' => 'ข่าวร่าง', 'post_status' => '0', 'created_at' => '2026-10-13']);
        DB::table('posts')->insert(['uid' => '236', 'category_id' => 1, 'sub_category_id' => 10, 'post_title' => 'ข่าววิดีโอ', 'post_youtube_embed' => '<iframe title="วิดีโอตัวอย่าง" src="https://www.youtube.com/embed/example"></iframe>', 'post_status' => '1', 'created_at' => '2026-10-10']);
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->andReturn(collect([
            ['uid' => '6494479976512721', 'category_name' => 'ประชาสัมพันธ์', 'sub_categories' => [
                ['uid' => '6953297868715565', 'sub_category_name' => 'ข่าวสาร'],
            ]],
        ]));
        $helper->shouldReceive('recentPosts')->with(5)->andReturn(collect([
            (object) ['uid' => '5200260212700590', 'post_title' => 'ข่าวทดสอบ', 'post_image' => null, 'created_at' => '2026-10-12'],
            (object) ['uid' => '234', 'post_title' => 'ข่าวที่เกี่ยวข้อง', 'post_image' => null, 'created_at' => '2026-10-11'],
        ]));
        $helper->shouldReceive('popularPosts')->with(4)->andReturn(collect([
            (object) ['uid' => '234', 'post_title' => 'ข่าวยอดนิยม', 'views_count' => 1200],
        ]));
        $controller = new ArticleController();
        $controller->helperCore = $helper;
        $this->app->instance(ArticleController::class, $controller);

        $response = $this->get('/posts/5200260212700590');
        $response->assertStatus(200)->assertViewIs('frontend.article.show')
            ->assertSee('<h1 id="post-detail-title">ข่าวทดสอบ</h1>')
            ->assertSee('เนื้อหาจากระบบเดิม')->assertSee('href="/documents/report.pdf"')
            ->assertSee('href="'.url('/posts/234').'"')
            ->assertSee('id="post-sidebar-recent-title"')->assertSee('id="post-sidebar-categories-title"')
            ->assertSee('id="post-sidebar-popular-title"')->assertSee('id="post-sidebar-topics-title"')
            ->assertSee('ข่าวยอดนิยม')->assertSee('เข้าชม 1,200 ครั้ง')
            ->assertSee('category=6494479976512721&amp;sub_category=6953297868715565')
            ->assertDontSee('ข่าวร่าง')->assertDontSee('href="'.url('/article/'));
        $this->get('/posts/235')->assertStatus(404);
        $this->get('/posts/236')->assertStatus(200)
            ->assertSee('class="post-detail-video"')
            ->assertSee('title="วิดีโอตัวอย่าง"');
    }
}
