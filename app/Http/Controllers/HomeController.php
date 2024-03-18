<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\Media;
use App\Event;
use App\User;
use App\Category;
use App\SubCategory;
use App\EventImage;
use Carbon\Carbon;
use App\Http\Helpers\HelperCore;

class HomeController extends Controller
{
    public $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function index(Request $request)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $events = Event::where('publishing_status', '1')
            ->orderBy('event_date', 'DESC')
            ->limit(1)
            ->get();
//
//        $media_list = Media::where('publishing_status', '1')
//            ->where('live_status', '!=', '0')
//            ->orderBy('created_at', 'DESC')
//            ->orderByViews()
//            ->limit(3)
//            ->get();

        $active = array('name' => '');
//        $popular_post = Post::leftJoin('users', 'posts.user_id', 'users.id')
//            ->select([
//                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id','posts.post_title','posts.post_slug','posts.post_image','posts.post_status', 'posts.created_at',
//                'users.name'
//            ])
//            ->where('post_status', '1')
//            ->orderByViews()
//            ->limit(8)
//            ->get();

        $new_post = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->join('categories', 'categories.id', 'posts.category_id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'post_youtube_embed', 'post_youtube_link', 'posts.sub_category_id', 'posts.post_title', 'posts.post_detail', 'posts.post_slug', 'posts.post_image', 'posts.post_status', 'posts.created_at',
                'users.name',
                'categories.category_name'
            ])
            ->where('post_status', '1')
            ->orderBy('created_at', 'DESC')
            ->first(1);

        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->join('categories', 'categories.id', 'posts.category_id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id', 'posts.post_title', 'posts.post_slug', 'posts.post_image', 'posts.post_status', 'posts.created_at',
                'users.name',
                'categories.category_name'
            ])
            ->where('post_status', '1')
            ->orderBy('created_at', 'DESC');

        if ($new_post) {
            $posts = $posts->where("posts.id", "!=", $new_post->id);
        }

        if (!empty($request->name)) {
            $posts = $posts->where(function ($query) use ($request) {
                $query->where("posts.post_title", "LIKE", "%{$request->name}%")
                    ->orWhere("posts.post_detail", "LIKE", "%{$request->name}%");
            });
            $active['name'] = $request->name;
        }

        $posts = $posts->paginate(12)->appends(request()->except('page'));
        return view('frontend.home.index', compact('category_menu', 'new_post', 'posts', 'active', 'events'));

//        return view('frontend.index', compact('events', 'media_list', 'popular_post', 'new_post'));
    }

    public function index1()
    {
//        $category_menu = $this->helperCore->getCategoryMenu();
//        return $category_menu;
//        return view('frontend.home.index', compact('category_menu'));
        $events = Event::where('publishing_status', '1')
            ->orderBy('created_at', 'DESC')
            ->with('user')
            ->orderByViews()
            ->limit(8)
            ->get();

        $media_list = Media::where('publishing_status', '1')
            ->where('live_status', '!=', '0')
            ->orderBy('created_at', 'DESC')
            ->orderByViews()
            ->limit(3)
            ->get();

        $popular_post = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('post_status', '1')
            ->orderByViews()
            ->limit(8)
            ->get();
        $new_post = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('post_status', '1')
            ->orderBy('created_at', 'DESC')
            ->orderByViews()
            ->limit(8)
            ->get();
        return view('frontend.index', compact('events', 'media_list', 'popular_post', 'new_post'));
    }

    public function post_detail($slug)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $sub_categories = $this->helperCore->getSubCategories();
        $active = array('name' => '');

        $post = Post::join('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'posts.sub_category_id', 'sub_categories.id')
            ->leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'categories.category_name', 'categories.category_slug', 'sub_categories.sub_category_name', 'sub_categories.sub_category_slug', 'users.name')
            ->where('post_status', '1')
            ->where('post_slug', $slug)
            ->firstOrFail();
        $expiresAt = now()->addHours(3);
        views($post)
            ->delayInSession($expiresAt)
            ->record();
        $views = views($post)->count();

        $post_related = Post::where('post_status', '1')
            ->where('posts.sub_category_id', $post->sub_category_id)
            ->where('posts.category_id', $post->category_id)
            ->where('posts.id', '!=', $post->id)
            ->select(['posts.post_title', 'posts.post_slug', 'posts.post_detail', 'posts.created_at', 'posts.post_image'])
            ->inRandomOrder()
            ->limit(2)
            ->get();

        return view('frontend.article.show', compact('category_menu', 'post', 'views', 'active', 'recent_posts', 'categories', 'sub_categories', 'popular_posts', 'post_related'));
//        return view('frontend.article.show', compact('post', 'views'));
    }

    public function post_detail1($slug)
    {
        $post = Post::join('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'posts.sub_category_id', 'sub_categories.id')
            ->leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'categories.category_name', 'categories.category_slug', 'sub_categories.sub_category_name', 'sub_categories.sub_category_slug', 'users.name')
            ->where('post_status', '1')
            ->where('post_slug', $slug)
            ->first();
        $expiresAt = now()->addHours(3);
        views($post)
            ->delayInSession($expiresAt)
            ->record();
        $views = views($post)->count();

        return view('frontend.post_detail', compact('post', 'views'));
    }

    public function event()
    {
        $events = Event::where('publishing_status', '1')->orderBy('created_at', 'DESC')->orderByViews()->paginate(12);
        return view('frontend.event', compact('events'));
    }

    public function event_detail($slug)
    {
        $event = Event::with('user')
            ->where('events.event_slug', $slug)
            ->where('publishing_status', '1')
            ->orderByViews()
            ->first();

        $expiresAt = now()->addHours(3);
        views($event)
            ->delayInSession($expiresAt)
            ->record();
        // $event->addViewWithExpiryDate(Carbon::now()->addHours(2));
        $images = EventImage::where('event_id', $event->id)->get();
        return view('frontend.event_detail', compact('event', 'images'));
    }

    public function about()
    {
        return view('frontend.about');
    }
}
