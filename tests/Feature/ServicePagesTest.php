<?php

namespace Tests\Feature;

use App\Http\Controllers\ServiceController;
use App\Http\Helpers\HelperCore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Tests\TestCase;

class ServicePagesTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        config(['session.driver' => 'array', 'cache.default' => 'array']);
    }

    private function menuController($expectedCalls)
    {
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->times($expectedCalls)->andReturn(collect([
            ['uid' => 'news', 'category_name' => 'ข่าวจากฐานข้อมูล', 'sub_categories' => []],
        ]));
        $controller = new ServiceController();
        $controller->helperCore = $helper;
        $this->app->instance(ServiceController::class, $controller);
    }

    public function test_real_service_unit_route_keeps_database_order_status_and_detail_links()
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('services', function (Blueprint $table) {
            $table->string('uid');
            $table->string('service_name');
            $table->string('service_type');
            $table->string('service_status');
            $table->integer('service_sequence');
        });
        Schema::create('service_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_uid');
            $table->string('service_image_type');
            $table->string('service_image_status');
            $table->string('service_image_file_name');
            $table->integer('service_image_sequence')->nullable();
        });
        DB::table('services')->insert([
            ['uid' => '2', 'service_name' => 'หน่วยบริการร่องคำ', 'service_type' => 'service_unit', 'service_status' => 'active', 'service_sequence' => 2],
            ['uid' => '1', 'service_name' => 'หน่วยบริการเมือง', 'service_type' => 'service_unit', 'service_status' => 'active', 'service_sequence' => 1],
            ['uid' => '3', 'service_name' => 'หน่วยบริการที่ปิด', 'service_type' => 'service_unit', 'service_status' => 'inactive', 'service_sequence' => 3],
            ['uid' => '4', 'service_name' => 'ห้องเรียนทดสอบ', 'service_type' => 'classroom', 'service_status' => 'active', 'service_sequence' => 4],
        ]);
        DB::table('service_images')->insert([
            ['service_uid' => '1', 'service_image_type' => 'banner', 'service_image_status' => 'active', 'service_image_file_name' => 'city.png', 'service_image_sequence' => 1],
            ['service_uid' => '1', 'service_image_type' => 'banner', 'service_image_status' => 'active', 'service_image_file_name' => 'city-old.png', 'service_image_sequence' => 2],
            ['service_uid' => '2', 'service_image_type' => 'banner', 'service_image_status' => 'active', 'service_image_file_name' => 'rongkham.png', 'service_image_sequence' => 1],
        ]);
        $this->menuController(1);

        $response = $this->get('/services?service_type=service_unit');
        $response->assertStatus(200)->assertViewIs('frontend.service.index')
            ->assertSee('ข่าวจากฐานข้อมูล')->assertSee('หน่วยบริการเมือง')
            ->assertSee('หน่วยบริการร่องคำ')->assertSee('city.png')->assertSee('rongkham.png')
            ->assertDontSee('city-old.png')
            ->assertSee('https://sks.go.th/images/service/thumbnail/city.png')
            ->assertSee('href="'.url('/services/1').'"')
            ->assertSee('href="'.url('/services/2').'"')
            ->assertDontSee('หน่วยบริการที่ปิด')->assertDontSee('ห้องเรียนทดสอบ')
            ->assertDontSee('noindex')->assertDontSee('/preview/services');
        $this->assertLessThan(strpos($response->getContent(), 'หน่วยบริการร่องคำ'), strpos($response->getContent(), 'หน่วยบริการเมือง'));
        $this->assertSame(2, substr_count($response->getContent(), '<article class="service-list-card">'));
        $this->assertStringContainsString('rel="canonical" href="'.url('/services?service_type=service_unit').'"', $response->getContent());
    }

    public function test_preview_uses_real_view_and_public_snapshot_without_database()
    {
        $this->menuController(0);
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config)
            {
                throw new \RuntimeException('Service preview must not open a database connection.');
            }
        });
        $this->get('/preview/services?service_type=service_unit')
            ->assertStatus(200)->assertViewIs('frontend.service.index')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertHeader('Cache-Control', 'no-store, private')
            ->assertSee('หน่วยบริการเมือง')->assertSee('หน่วยบริการร่องคำ')
            ->assertSee('https://sks.go.th/images/service/thumbnail/banner-12a952815a598136ef9569cd5355f571.png')
            ->assertSee('https://sks.go.th/services/1219441341152823');
        $this->get('/preview/services?service_type=classroom')->assertStatus(404);
        $this->get('/preview/home')->assertStatus(200)
            ->assertSee(route('preview.services', ['service_type' => 'service_unit']));
    }

    public function test_empty_listing_explains_the_state_instead_of_showing_blog_copy()
    {
        $html = view('frontend.service.index', [
            'category_menu' => collect(),
            'services' => collect(),
            'serviceType' => 'classroom',
            'serviceTitle' => 'ห้องเรียน',
            'servicePreview' => false,
            'aboutPage' => 'services',
            'aboutPreview' => false,
            'publicCanonical' => url('/services?service_type=classroom'),
        ])->render();
        $this->assertStringContainsString('0 รายการ', $html);
        $this->assertStringContainsString('ยังไม่มีข้อมูลห้องเรียน', $html);
        $this->assertStringContainsString('href="'.url('/contact').'"', $html);
        $this->assertStringNotContainsString('ไม่พบบทความในหมวดหมู่นี้', $html);
    }

    public function test_real_detail_preserves_service_content_and_safe_media_and_map()
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('services', function (Blueprint $table) {
            $table->string('uid');
            $table->string('service_name');
            $table->string('service_type');
            $table->text('service_description');
            $table->text('service_mission')->nullable();
            $table->text('service_learning_activity')->nullable();
            $table->string('service_address')->nullable();
            $table->string('service_contact_phone_number')->nullable();
            $table->string('service_contact_name')->nullable();
            $table->text('service_embed_map')->nullable();
        });
        Schema::create('service_images', function (Blueprint $table) {
            $table->string('service_uid');
            $table->string('service_image_type');
            $table->string('service_image_status');
            $table->integer('service_image_sequence');
            $table->string('service_image_file_name');
            $table->string('service_image_name')->nullable();
            $table->string('service_image_description')->nullable();
        });
        DB::table('services')->insert([
            'uid' => 'unit-1', 'service_name' => 'หน่วยบริการทดสอบ', 'service_type' => 'service_unit',
            'service_description' => 'รายละเอียดหน่วยบริการ',
            'service_mission' => "ภารกิจ 1\n<script>alert(1)</script>",
            'service_learning_activity' => "กิจกรรม 1\nกิจกรรม 2",
            'service_address' => 'ตำบลทดสอบ จังหวัดกาฬสินธุ์',
            'service_contact_phone_number' => '087-123-4567',
            'service_contact_name' => 'ผู้ประสานงาน',
            'service_embed_map' => '<iframe src="https://www.google.com/maps/embed?pb=test"></iframe><script>alert(2)</script>',
        ]);
        DB::table('service_images')->insert([
            ['service_uid' => 'unit-1', 'service_image_type' => 'banner', 'service_image_status' => 'active', 'service_image_sequence' => 1, 'service_image_file_name' => 'banner.png', 'service_image_name' => '', 'service_image_description' => ''],
            ['service_uid' => 'unit-1', 'service_image_type' => 'general', 'service_image_status' => 'active', 'service_image_sequence' => 2, 'service_image_file_name' => 'first.jpg', 'service_image_name' => 'ภาพแรก', 'service_image_description' => 'คำอธิบายภาพ'],
            ['service_uid' => 'unit-1', 'service_image_type' => 'general', 'service_image_status' => 'inactive', 'service_image_sequence' => 3, 'service_image_file_name' => 'inactive.jpg', 'service_image_name' => 'ภาพปิด', 'service_image_description' => ''],
        ]);
        $this->menuController(1);

        $response = $this->get('/services/unit-1');
        $response->assertStatus(200)->assertViewIs('frontend.service.show')
            ->assertSee('หน่วยบริการทดสอบ')->assertSee('บทบาทหน้าที่และภารกิจ')
            ->assertSee('คำอธิบายภาพ')->assertSee('tel:0871234567')
            ->assertSee('https://www.google.com/maps/embed?pb=test')
            ->assertSee('https://sks.go.th/images/service/banner.png')
            ->assertDontSee('inactive.jpg')->assertDontSee('<script>alert(1)</script>')
            ->assertDontSee('<script>alert(2)</script>');
        $this->assertStringContainsString('rel="canonical" href="'.url('/services/unit-1').'"', $response->getContent());
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $response->getContent());
    }

    public function test_service_detail_preview_uses_the_real_view_without_database()
    {
        $this->menuController(0);
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config)
            {
                throw new \RuntimeException('Service detail preview must not open a database connection.');
            }
        });
        $this->get('/preview/services/8793671705672554')
            ->assertStatus(200)->assertViewIs('frontend.service.show')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('หน่วยบริการร่องคำ')->assertSee('0872310353')
            ->assertSee('กิจกรรมครูพาทำ')
            ->assertSee('href="'.route('preview.services', ['service_type' => 'service_unit']).'"')
            ->assertSee('https://sks.go.th/images/service/banner-a16591740daaa1ca38193c77645e54c1.png');
        $this->get('/preview/services/999')->assertStatus(404);
    }
}
