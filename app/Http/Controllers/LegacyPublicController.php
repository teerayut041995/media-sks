<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventImage;
use App\Http\Helpers\HelperCore;
use App\Post;

class LegacyPublicController extends Controller
{
    private $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function post_detail($slug)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $sub_categories = $this->helperCore->getSubCategories();
        $active = ['name' => ''];

        $post = Post::join('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'posts.sub_category_id', 'sub_categories.id')
            ->leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'categories.category_name', 'categories.category_slug',
                'sub_categories.sub_category_name', 'sub_categories.sub_category_slug', 'users.name')
            ->where('post_status', '1')
            ->where('post_slug', $slug)
            ->firstOrFail();
        views($post)->delayInSession(now()->addHours(24))->record();
        $views = views($post)->count();

        $post_related = Post::where('post_status', '1')
            ->where('posts.sub_category_id', $post->sub_category_id)
            ->where('posts.category_id', $post->category_id)
            ->where('posts.id', '!=', $post->id)
            ->select(['posts.post_title', 'posts.post_slug', 'posts.post_detail', 'posts.created_at', 'posts.post_image'])
            ->inRandomOrder()->limit(2)->get();

        return view('frontend.article.show', compact(
            'category_menu', 'post', 'views', 'active', 'recent_posts', 'categories',
            'sub_categories', 'popular_posts', 'post_related'
        ));
    }

    public function event()
    {
        $events = Event::where('publishing_status', '1')
            ->orderBy('created_at', 'DESC')->orderByViews()->paginate(12);
        return view('frontend.event', compact('events'));
    }

    public function event_detail($slug)
    {
        $event = Event::with('user')
            ->where('events.event_slug', $slug)
            ->where('publishing_status', '1')
            ->orderByViews()->firstOrFail();
        views($event)->delayInSession(now()->addHours(24))->record();
        $images = EventImage::where('event_id', $event->id)->get();
        return view('frontend.event_detail', compact('event', 'images'));
    }

    public function about()
    {
        return view('frontend.about');
    }
}
