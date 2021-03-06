<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Post;
use App\Media;
use App\Event;
use App\User;
use App\EventImage;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('publishing_status' , '1')
            ->orderBy('created_at' , 'DESC')
            ->with('user')
            ->orderByViews()
            ->limit(8)
            ->get();

        $media_list = Media::where('publishing_status' , '1')
            ->where('live_status' , '!=' ,  '0')
            ->orderBy('created_at' , 'DESC')
            ->orderByViews()
            ->limit(3)
            ->get();

    	$popular_post = Post::leftJoin('users' , 'posts.user_id' , 'users.id')
    			->select('posts.*' , 'users.name')
    			->where('post_status' , '1')
    			->orderByViews()
    			->limit(8)
    			->get();
    	$new_post = Post::leftJoin('users' , 'posts.user_id' , 'users.id')
    			->select('posts.*' , 'users.name')
    			->where('post_status' , '1')
    			->orderBy('created_at' , 'DESC')
                ->orderByViews()
    			->limit(8)
    			->get();
    	return view('frontend.index' , compact('events','media_list','popular_post','new_post'));
    }

    public function post_detail($slug)
    {
    	$post = Post::join('categories' , 'posts.category_id' , 'categories.id')
    					->leftJoin('sub_categories' , 'posts.sub_category_id' , 'sub_categories.id')
    					->leftJoin('users' , 'posts.user_id' , 'users.id')
    					->select('posts.*' , 'categories.category_name' , 'categories.category_slug' , 'sub_categories.sub_category_name' , 'sub_categories.sub_category_slug' , 'users.name')
    					->where('post_status' , '1')
    					->where('post_slug' , $slug)
    					->first();
        $expiresAt = now()->addHours(3);
        views($post)
            ->delayInSession($expiresAt)
            ->record();
        $views = views($post)->count();

       return view('frontend.post_detail' , compact('post','views'));
    }
    public function event()
    {
        $events = Event::where('publishing_status' , '1')->orderBy('created_at' , 'DESC')->orderByViews()->paginate(12);
        return view('frontend.event',compact('events'));
    }
    public function event_detail($slug)
    {   
        $event = Event::with('user')
                    ->where('events.event_slug' , $slug)
                    ->where('publishing_status' , '1')
                    ->orderByViews()
                    ->first();

        $expiresAt = now()->addHours(3);
        views($event)
            ->delayInSession($expiresAt)
            ->record();
        // $event->addViewWithExpiryDate(Carbon::now()->addHours(2));
        $images = EventImage::where('event_id' , $event->id)->get();
        return view('frontend.event_detail' , compact('event' , 'images'));
    }

    public function about()
    {
        return view('frontend.about');
    }
}
