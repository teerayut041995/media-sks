<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventImage;
use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Post;
use Carbon\Carbon;
use App\Http\Helpers\HelperCore;

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
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();

        $active = array('name' => '');
        $events = Event::leftJoin('users', 'events.user_id', 'users.id')
            ->select('events.*', 'users.name')
            ->where('events.publishing_status', '1')
            ->orderBy('events.created_at', 'DESC');
//                ->orderByViews()
        if (!empty($request->name)) {
            $events = $events->where(function ($query) use ($request) {
                $query->where("events.event_name", "LIKE", "%{$request->name}%")
                    ->orWhere("events.event_description", "LIKE", "%{$request->name}%");
            });
//            $posts = $posts->where("posts.post_title", "LIKE", "%{$request->name}%");
            $active['name'] = $request->name;
        }
        $events = $events->paginate(12)->appends(request()->except('page'));
        return view('frontend.event.index', compact('category_menu', 'active', 'events', 'recent_posts', 'categories', 'popular_posts'));
    }

    public function show($event_uid)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $active = array('name' => '');

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
        $images = EventImage::where('event_id', $event->id)->get();

        return view('frontend.event.show', compact('category_menu', 'event', 'images', 'views', 'active', 'recent_posts', 'categories', 'popular_posts'));
//        return view('frontend.article.show', compact('post', 'views'));
    }

}
