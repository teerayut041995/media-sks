<?php

namespace Tests\Feature;

use App\Http\Controllers\EventController;
use App\Http\Helpers\HelperCore;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EventPagesTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        config(['session.driver' => 'array', 'cache.default' => 'array']);
    }

    private function mockMenu($calls)
    {
        $helper = \Mockery::mock(HelperCore::class);
        $helper->shouldReceive('getCategoryMenu')->times($calls)->andReturn(collect([
            ['uid' => 'news', 'category_name' => 'ข่าวจากฐานข้อมูล', 'sub_categories' => []],
        ]));
        $controller = new EventController();
        $controller->helperCore = $helper;
        $this->app->instance(EventController::class, $controller);
    }

    private function createTables()
    {
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid');
            $table->integer('user_id')->nullable();
            $table->string('event_name');
            $table->string('event_slug')->nullable();
            $table->text('event_description')->nullable();
            $table->string('event_image')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_location')->nullable();
            $table->string('publishing_status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function test_real_event_route_keeps_published_order_search_and_detail_urls()
    {
        $this->createTables();
        DB::table('users')->insert(['id' => 1, 'name' => 'ผู้ดูแล']);
        DB::table('events')->insert([
            ['uid' => '101', 'user_id' => 1, 'event_name' => 'กิจกรรมล่าสุด', 'event_description' => 'งานของนักเรียน', 'event_image' => 'latest.jpg', 'publishing_status' => '1', 'created_at' => '2026-10-05', 'updated_at' => '2026-10-05'],
            ['uid' => '102', 'user_id' => 1, 'event_name' => 'กิจกรรมก่อนหน้า', 'event_description' => 'กิจกรรมร่วมชุมชน', 'event_image' => 'older.jpg', 'publishing_status' => '1', 'created_at' => '2026-09-05', 'updated_at' => '2026-09-05'],
            ['uid' => '103', 'user_id' => 1, 'event_name' => 'กิจกรรมที่ยังไม่เผยแพร่', 'event_description' => '', 'event_image' => 'hidden.jpg', 'publishing_status' => '0', 'created_at' => '2026-10-10', 'updated_at' => '2026-10-10'],
        ]);
        $this->mockMenu(2);

        $response = $this->get('/events');
        $response->assertStatus(200)->assertViewIs('frontend.event.index')
            ->assertSee('ข่าวจากฐานข้อมูล')->assertSee('กิจกรรมล่าสุด')
            ->assertSee('กิจกรรมก่อนหน้า')->assertDontSee('กิจกรรมที่ยังไม่เผยแพร่')
            ->assertSee('href="'.url('/events/101').'"')
            ->assertSee('href="'.url('/events/102').'"')
            ->assertSee('name="name"')
            ->assertSee('href="'.url('/events').'"')
            ->assertSee('>กิจกรรม</a>')
            ->assertDontSee('>ภาพกิจกรรม</a>')->assertDontSee('noindex');
        $this->assertLessThan(strpos($response->getContent(), 'กิจกรรมก่อนหน้า'), strpos($response->getContent(), 'กิจกรรมล่าสุด'));

        $this->get('/events?name='.urlencode('ร่วมชุมชน'))->assertStatus(200)
            ->assertSee('กิจกรรมก่อนหน้า')->assertDontSee('กิจกรรมล่าสุด')
            ->assertSee('คำค้น')->assertSee('ล้างคำค้นหา');
    }

    public function test_real_event_pagination_preserves_search_query()
    {
        $this->createTables();
        $rows = [];
        for ($i = 1; $i <= 13; $i++) {
            $rows[] = [
                'uid' => (string) $i, 'user_id' => null, 'event_name' => 'เรียนรู้ '.$i,
                'event_description' => '', 'event_image' => 'image.jpg',
                'publishing_status' => '1', 'created_at' => sprintf('2026-10-%02d', $i),
                'updated_at' => sprintf('2026-10-%02d', $i),
            ];
        }
        DB::table('events')->insert($rows);
        $this->mockMenu(2);

        $this->get('/events?name='.urlencode('เรียนรู้'))->assertStatus(200)
            ->assertSee('พบ 13 รายการ')->assertSee('name=%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99%E0%B8%A3%E0%B8%B9%E0%B9%89')
            ->assertSee('aria-current="page"');
        $this->get('/events?name='.urlencode('เรียนรู้').'&page=2')->assertStatus(200)
            ->assertSee('เรียนรู้ 1')->assertDontSee('เรียนรู้ 13');
    }

    public function test_preview_uses_same_view_with_snapshot_and_no_database()
    {
        $this->mockMenu(0);
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config)
            {
                throw new \RuntimeException('The event preview must not connect to the database.');
            }
        });
        $this->get('/preview/events')->assertStatus(200)
            ->assertViewIs('frontend.event.index')->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertHeader('Cache-Control', 'no-store, private')
            ->assertSee('พบ 36 รายการ')
            ->assertSee('href="'.route('preview.events').'"')
            ->assertSee('>กิจกรรม</a>')
            ->assertDontSee('>ภาพกิจกรรม</a>')
            ->assertSee(route('preview.events.show', ['event_uid' => '4557258015376265']))
            ->assertSee('https://sks.go.th/images/image_event/f0afb4f090f4637d78c7fa0dd51f8465.jpg');
        $this->get('/preview/events?name='.urlencode('ไม่พบแน่นอน'))->assertStatus(200)
            ->assertSee('ไม่พบกิจกรรมที่ตรงกับคำค้นหา')
            ->assertSee('ดูกิจกรรมทั้งหมด');
    }

    public function test_real_event_detail_keeps_activity_data_gallery_and_view_recording()
    {
        $this->createTables();
        Schema::create('event_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->string('image_name');
        });
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('viewable');
            $table->text('visitor')->nullable();
            $table->string('collection')->nullable();
            $table->timestamp('viewed_at')->nullable();
        });
        DB::table('users')->insert(['id' => 1, 'name' => 'งานประชาสัมพันธ์']);
        DB::table('events')->insert([
            'id' => 7, 'uid' => '455', 'user_id' => 1,
            'event_name' => 'กิจกรรมตัวอย่าง',
            'event_description' => '<p>เนื้อหา <strong>กิจกรรม</strong></p><script>alert(1)</script>',
            'event_image' => 'cover.jpg', 'event_date' => '2026-08-11',
            'event_location' => 'ศูนย์การศึกษาพิเศษ', 'publishing_status' => '1',
            'created_at' => '2026-09-21', 'updated_at' => '2026-09-21',
        ]);
        DB::table('event_images')->insert([
            ['event_id' => 7, 'image_name' => 'one.jpg'],
            ['event_id' => 7, 'image_name' => 'two.jpg'],
        ]);
        $this->mockMenu(1);

        $response = $this->get('/events/455');
        $response->assertStatus(200)->assertViewIs('frontend.event.show')
            ->assertSee('กิจกรรมตัวอย่าง')->assertSee('11 ส.ค. 2569')
            ->assertSee('ศูนย์การศึกษาพิเศษ')->assertSee('งานประชาสัมพันธ์')
            ->assertSee('เข้าชม')->assertSee('2 ภาพ')
            ->assertSee('one.jpg')->assertSee('two.jpg')
            ->assertSee('เนื้อหา กิจกรรม')
            ->assertDontSee('<script>alert(1)</script>')
            ->assertDontSee('noindex');
        $this->assertStringContainsString('rel="canonical" href="'.url('/events/455').'"', $response->getContent());
        $this->get('/'.rawurlencode('กิจกรรม').'/not-found')->assertStatus(404);
    }

    public function test_detail_preview_uses_real_view_and_twenty_live_images_without_database()
    {
        $this->mockMenu(0);
        $this->app->instance('db.connector.mysql', new class implements \Illuminate\Database\Connectors\ConnectorInterface {
            public function connect(array $config)
            {
                throw new \RuntimeException('Event detail preview must not connect to the database.');
            }
        });
        $this->get('/preview/events/4557258015376265')->assertStatus(200)
            ->assertViewIs('frontend.event.show')
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('20 ภาพ')
            ->assertSee('79bb0ab8d028da2f58039af546ce157a.jpg')
            ->assertSee('วันที่จัดกิจกรรม')
            ->assertSee('11 ส.ค. 2569')
            ->assertSee('event-detail.js');
        $this->get('/preview/events/4712334485356745')->assertStatus(404);
    }
}
