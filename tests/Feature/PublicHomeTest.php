<?php

namespace Tests\Feature;

use App\Http\Controllers\HomeController;
use App\Http\Helpers\HelperCore;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PublicHomeTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        config([
            'session.driver' => 'array',
            'cache.default' => 'array',
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('category_id');
            $table->string('post_title');
            $table->text('post_detail')->nullable();
            $table->string('post_image')->nullable();
            $table->string('post_image_thumbnail_file_name')->nullable();
            $table->string('post_status');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('event_name');
            $table->text('event_description')->nullable();
            $table->string('event_image')->nullable();
            $table->date('event_date')->nullable();
            $table->string('publishing_status');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->string('service_name');
            $table->text('service_description')->nullable();
            $table->string('service_status');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_name');
            $table->string('banner_file_name')->nullable();
            $table->string('banner_first_link')->nullable();
            $table->integer('banner_sequence');
            $table->string('banner_status');
        });

        DB::table('categories')->insert([
            ['id' => 1, 'category_name' => 'ประชาสัมพันธ์'],
            ['id' => 2, 'category_name' => 'รางวัลและผลงาน'],
            ['id' => 3, 'category_name' => 'ดาวน์โหลด'],
        ]);
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->andReturn(collect([
            ['id' => 1, 'uid' => 'news', 'category_name' => 'ประชาสัมพันธ์', 'sub_categories' => []],
            ['id' => 2, 'uid' => 'awards', 'category_name' => 'รางวัลและผลงาน', 'sub_categories' => []],
            ['id' => 3, 'uid' => 'downloads', 'category_name' => 'ดาวน์โหลด', 'sub_categories' => []],
        ]));
        $controller = new HomeController();
        $controller->helperCore = $helper;
        $this->app->instance(HomeController::class, $controller);
    }

    public function test_home_uses_real_routes_and_only_published_content()
    {
        DB::table('posts')->insert([
            ['uid' => '101', 'category_id' => 1, 'post_title' => 'ข่าวล่าสุด', 'post_detail' => 'รายละเอียดข่าว', 'post_status' => '1', 'created_at' => '2026-10-12'],
            ['uid' => '102', 'category_id' => 1, 'post_title' => 'ข่าวก่อนหน้า', 'post_detail' => 'รายละเอียดข่าว', 'post_status' => '1', 'created_at' => '2026-10-11'],
            ['uid' => '103', 'category_id' => 1, 'post_title' => 'ข่าวร่าง', 'post_detail' => null, 'post_status' => '0', 'created_at' => '2026-10-13'],
            ['uid' => '104', 'category_id' => 2, 'post_title' => 'รางวัลดีเด่น', 'post_detail' => null, 'post_status' => '1', 'created_at' => '2026-10-10'],
            ['uid' => '105', 'category_id' => 3, 'post_title' => 'แบบฟอร์ม', 'post_detail' => null, 'post_status' => '1', 'created_at' => '2026-10-09'],
        ]);
        DB::table('events')->insert(['uid' => '201', 'event_name' => 'กิจกรรมล่าสุด', 'event_description' => 'กิจกรรม', 'event_date' => '2026-10-10', 'publishing_status' => '1', 'created_at' => '2026-10-10']);
        DB::table('banners')->insert(['banner_name' => 'ประกาศสำคัญ', 'banner_file_name' => 'banner.jpg', 'banner_first_link' => 'https://example.org', 'banner_sequence' => 1, 'banner_status' => 'active']);

        $response = $this->get('/');
        $response->assertStatus(200)->assertViewIs('frontend.home.public')
            ->assertSee('ข่าวล่าสุด')->assertSee('ข่าวก่อนหน้า')->assertSee('รางวัลดีเด่น')
            ->assertSee('กิจกรรมล่าสุด')->assertSee('แบบฟอร์ม')->assertDontSee('ข่าวร่าง')
            ->assertSee('href="'.url('/posts/101').'"')
            ->assertSee('href="'.url('/events/201').'"')
            ->assertSee('width="1920" height="640"')
            ->assertDontSee('noindex, nofollow')
            ->assertDontSee('/preview/posts/101');
    }

    public function test_search_covers_public_content_and_rejects_unpublished_records()
    {
        DB::table('posts')->insert([
            ['uid' => '101', 'category_id' => 1, 'post_title' => 'บริการเด็ก', 'post_detail' => 'ข่าว', 'post_status' => '1', 'created_at' => '2026-10-12'],
            ['uid' => '102', 'category_id' => 1, 'post_title' => 'บริการลับ', 'post_detail' => 'ข่าว', 'post_status' => '0', 'created_at' => '2026-10-13'],
        ]);
        DB::table('events')->insert(['uid' => '201', 'event_name' => 'กิจกรรมบริการ', 'event_description' => 'รายละเอียด', 'publishing_status' => '1', 'created_at' => '2026-10-10']);
        DB::table('services')->insert(['uid' => '301', 'service_name' => 'หน่วยบริการ', 'service_description' => 'พื้นที่', 'service_status' => 'active', 'created_at' => '2026-10-09']);

        $response = $this->get('/?q='.urlencode('บริการ'));
        $response->assertStatus(200)->assertViewHas('total', 3)
            ->assertSee('href="'.url('/posts/101').'"')
            ->assertSee('href="'.url('/events/201').'"')
            ->assertSee('href="'.url('/services/301').'"')
            ->assertDontSee('บริการลับ');
        $this->get('/?q[]=invalid&page[]=invalid')->assertStatus(200);
    }

    public function test_home_remains_usable_when_content_is_empty()
    {
        $this->get('/')->assertStatus(200)->assertSee('ทุกความเคลื่อนไหวของศูนย์');
    }

    public function test_public_contact_details_come_from_cached_configuration()
    {
        config([
            'public.contact_phone' => '099-111-2222',
            'public.contact_email' => 'info@example.org',
        ]);

        $this->get('/')->assertStatus(200)
            ->assertSee('099-111-2222')
            ->assertSee('info@example.org');
    }
}
