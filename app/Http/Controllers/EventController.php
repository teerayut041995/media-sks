<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventImage;
use Illuminate\Http\Request;
use App\Http\Helpers\HelperCore;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Support\PreviewMenu;

class EventController extends Controller
{
    public $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function index(Request $request)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $search = $request->input('name', '');
        $search = is_string($search) ? trim($search) : '';
        $active = ['name' => $search];
        $events = Event::leftJoin('users', 'events.user_id', 'users.id')
            ->select('events.*', 'users.name')
            ->where('events.publishing_status', '1')
            ->orderBy('events.created_at', 'DESC');
        if ($search !== '') {
            $events = $events->where(function ($query) use ($search) {
                $query->where('events.event_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('events.event_description', 'LIKE', '%'.$search.'%');
            });
        }
        $events = $events->paginate(12)->appends(request()->except('page'));
        return $this->renderIndex($category_menu, $events, $active);
    }

    public function previewIndex(Request $request)
    {
        $snapshot = json_decode(file_get_contents(resource_path('data/home-preview.json')), true);
        $publishedDates = [
            '4557258015376265' => '2026-09-21', '6761955739092727' => '2026-09-16',
            '4492559071812991' => '2026-09-16', '6510391345760501' => '2026-07-09',
            '7490985297848272' => '2026-06-11', '1214279141699820' => '2026-06-02',
            '4197849755990198' => '2026-06-02', '8715161516000422' => '2026-04-23',
            '6246480012837556' => '2026-04-22', '1709961560004080' => '2026-04-19',
            '8246545132175040' => '2026-04-03', '6609744823437613' => '2026-01-22',
        ];
        $search = $request->input('name', '');
        $search = is_string($search) ? trim($search) : '';
        $records = collect($snapshot['records'])->filter(function ($record) {
            return $record['type'] === 'กิจกรรม';
        })->map(function ($record) use ($publishedDates) {
            return (object) [
                'uid' => $record['id'],
                'event_name' => $record['title'],
                'event_description' => $record['summary'],
                'event_image' => basename(parse_url($record['image'], PHP_URL_PATH)),
                'created_at' => $publishedDates[$record['id']] ?? $record['date'],
            ];
        })->values();
        if ($search !== '') {
            $records = $records->filter(function ($record) use ($search) {
                return mb_stripos($record->event_name, $search) !== false
                    || mb_stripos($record->event_description, $search) !== false;
            })->values();
        }
        $page = max(1, (int) $request->input('page', 1));
        $events = new LengthAwarePaginator($records->forPage($page, 12)->values(), $records->count(), 12, $page, [
            'path' => route('preview.events'),
        ]);
        $events->appends($request->except('page'));
        return $this->renderIndex(PreviewMenu::all(), $events, ['name' => $search], true);
    }

    private function renderIndex($category_menu, $events, $active, $eventPreview = false)
    {
        $aboutPage = 'events';
        $aboutPreview = $eventPreview;
        $publicCanonical = url('/events');
        $response = response()->view('frontend.event.index', compact(
            'category_menu', 'events', 'active', 'eventPreview', 'aboutPage', 'aboutPreview', 'publicCanonical'
        ));
        if ($eventPreview) {
            $response->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
        }
        return $response;
    }

    public function show($event_uid)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $event = Event::leftJoin('users', 'events.user_id', 'users.id')
            ->select('events.*', 'users.name')
            ->where('events.uid', $event_uid)
            ->where('events.publishing_status', '1')
            ->firstOrFail();

        $expiresAt = now()->addHours(3);
        views($event)
            ->delayInSession($expiresAt)
            ->record();

        $views = views($event)->count();
        $images = EventImage::where('event_id', $event->id)->orderBy('id')->get();

        return $this->renderShow($event, $images, $views, $category_menu);
    }

    public function previewShow($event_uid)
    {
        $content = json_decode(file_get_contents(resource_path('data/home-preview.json')), true);
        $record = collect($content['records'])->first(function ($item) use ($event_uid) {
            return $item['id'] === $event_uid && $item['type'] === 'กิจกรรม';
        });
        abort_unless($record, 404);

        $snapshot = json_decode(file_get_contents(resource_path('data/event-detail-preview.json')), true);
        $isCapturedDetail = $event_uid === $snapshot['uid'];
        $event = (object) [
            'uid' => $record['id'],
            'event_name' => $record['title'],
            'event_description' => implode("\n\n", $record['paragraphs']),
            'event_image' => basename(parse_url($record['image'], PHP_URL_PATH)),
            'event_date' => $record['date'],
            'event_location' => null,
            'created_at' => $isCapturedDetail ? $snapshot['published_at'] : $record['date'],
            'name' => $isCapturedDetail ? $snapshot['author'] : null,
        ];
        $images = collect($isCapturedDetail ? $snapshot['gallery'] : [])->map(function ($name) {
            return (object) ['image_name' => $name];
        });
        return $this->renderShow($event, $images, null, PreviewMenu::all(), true);
    }

    private function renderShow($event, $images, $views, $category_menu, $eventPreview = false)
    {
        $aboutPage = 'events';
        $aboutPreview = $eventPreview;
        $eventDetail = true;
        $publicArticle = true;
        $publicCanonical = url('/events/'.$event->uid);
        $imageName = !empty($event->event_image) ? basename($event->event_image) : null;
        $imagePath = $imageName ? 'images/image_event/'.$imageName : null;
        $publicOgImage = $imagePath
            ? (is_file(public_path($imagePath)) ? asset($imagePath) : 'https://sks.go.th/'.$imagePath)
            : null;
        $metaSource = preg_replace('~<(script|style)\b[^>]*>.*?</\1>~is', '', (string) $event->event_description);
        $eventMetaDescription = str_limit(trim(preg_replace(
            '/\s+/u', ' ', html_entity_decode(strip_tags($metaSource), ENT_QUOTES | ENT_HTML5, 'UTF-8')
        )), 155);

        $response = response()->view('frontend.event.show', compact(
            'category_menu', 'event', 'images', 'views', 'eventPreview', 'eventDetail',
            'aboutPage', 'aboutPreview', 'publicCanonical', 'publicOgImage', 'publicArticle',
            'eventMetaDescription'
        ));
        if ($eventPreview) {
            $response->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
        }
        return $response;
    }

}
