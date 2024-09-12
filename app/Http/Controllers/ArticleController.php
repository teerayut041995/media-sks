<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Post;
use Carbon\Carbon;
use App\Http\Helpers\HelperCore;

class ArticleController extends Controller
{
    public $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function category(Request $request, $slug)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $sub_categories = $this->helperCore->getSubCategories();
        $category = Category::where('category_status', '1')
            ->where('category_slug', $slug)
            ->firstOrFail();
        $active = array('name' => '');
        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id','posts.post_title','posts.post_slug','posts.post_image','posts.post_status', 'posts.created_at',
                'users.name'
            ])
            ->where('post_status', '1')
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'DESC');
//                ->orderByViews()
        if (!empty($request->name)) {
            $posts = $posts->where(function ($query) use ($request) {
                $query->where("posts.post_title", "LIKE", "%{$request->name}%")
                    ->orWhere("posts.post_detail", "LIKE", "%{$request->name}%");
            });
//            $posts = $posts->where("posts.post_title", "LIKE", "%{$request->name}%");
            $active['name'] = $request->name;
        }
        $posts = $posts->paginate(12)->appends(request()->except('page'));
        return view('frontend.article.index', compact('category_menu', 'category', 'posts', 'active', 'recent_posts', 'categories', 'sub_categories', 'popular_posts'));
    }

    public function sub_category($cate_slug, $sub_slug)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $sub_categories = $this->helperCore->getSubCategories();
        $active = array('name' => '');
        $category = SubCategory::join('categories', 'sub_categories.category_id', 'categories.id')
            ->select('sub_categories.id', 'sub_categories.sub_category_name', 'sub_categories.sub_category_slug', 'categories.category_name', 'categories.category_slug')
            ->where('sub_category_status', '1')
            ->where('sub_category_slug', $sub_slug)
            ->first();

        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id','posts.post_title','posts.post_slug','posts.post_image','posts.post_status', 'posts.created_at',
                'users.name'
            ])
            ->where('post_status', '1')
            ->where('sub_category_id', $category->id)
            ->orderBy('created_at', 'DESC');
//                ->orderByViews()
        if (!empty($request->name)) {
            $posts = $posts->where(function ($query) use ($request) {
                $query->where("posts.post_title", "LIKE", "%{$request->name}%")
                    ->orWhere("posts.post_detail", "LIKE", "%{$request->name}%");
            });
//            $posts = $posts->where("posts.post_title", "LIKE", "%{$request->name}%");
            $active['name'] = $request->name;
        }
        $posts = $posts->paginate(12)->appends(request()->except('page'));
        return view('frontend.article.sub-category', compact('category_menu', 'category', 'posts', 'active', 'recent_posts', 'categories', 'sub_categories', 'popular_posts'));
    }

    public function category1($slug)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $category = Category::where('category_status', '1')
            ->where('category_slug', $slug)
            ->first();
        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('post_status', '1')
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'DESC')
            ->orderByViews()
            ->paginate(12);
        return view('frontend.category', compact('category', 'posts'));
    }

    public function sub_category1($cate_slug, $sub_slug)
    {
        $category = SubCategory::join('categories', 'sub_categories.category_id', 'categories.id')
            ->select('sub_categories.*', 'categories.category_name', 'categories.category_slug')
            ->where('sub_category_status', '1')
            ->where('sub_category_slug', $sub_slug)
            ->first();
        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'users.name')
            ->where('post_status', '1')
            ->where('sub_category_id', $category->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);
        return view('frontend.sub_category', compact('category', 'posts'));
    }

    public function index(Request $request)
    {
//        return 1;
        $category_menu = $this->helperCore->getCategoryMenu();
//        return ['results' => $category_menu];
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
//        $sub_categories = $this->helperCore->getSubCategories();

        $active = array('name' => '');

        if (empty($request->category)) {
            return redirect('/');
        }
        $category_uid = NULL;
        $sub_category_uid = NULL;
        $category = Category::where('uid', $request->category)
            ->select('id', 'uid', 'category_name')
            ->firstOrFail();

        $category_uid = $category->uid;

        $sub_category = NULL;

        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id','posts.post_title','posts.post_slug','posts.post_image','posts.post_status', 'posts.created_at',
                'users.name'
            ])
            ->where('post_status', '1')
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'DESC');

        if (!empty($request->sub_category)) {
            $sub_category = SubCategory::where('uid', $request->sub_category)
                ->select('id', 'uid', 'sub_category_name')
                ->firstOrFail();
            $posts = $posts->where('sub_category_id', $sub_category->id);
            $sub_category_uid = $sub_category->uid;
        }

        if (!empty($request->name)) {
            $posts = $posts->where(function ($query) use ($request) {
                $query->where("posts.post_title", "LIKE", "%{$request->name}%")
                    ->orWhere("posts.post_detail", "LIKE", "%{$request->name}%");
            });
            $active['name'] = $request->name;
        }
        $posts = $posts->paginate(12)->appends(request()->except('page'));
        return view('frontend.article.index', compact('category_menu', 'category', 'sub_category', 'posts', 'active', 'recent_posts', 'categories', 'popular_posts'));

//        return view('user-panel.post.index', compact('main_menu', 'category', 'sub_category', 'category_uid', 'sub_category_uid'));
    }

    public function show($post_uid)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $active = array('name' => '');

        $post = Post::join('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'posts.sub_category_id', 'sub_categories.id')
            ->leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'categories.category_name', 'categories.category_slug', 'sub_categories.sub_category_name', 'sub_categories.sub_category_slug', 'users.name')
            ->where('post_status', '1')
            ->where('posts.uid', $post_uid)
            ->firstOrFail();
        $expiresAt = now()->addHours(24);
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

        return view('frontend.article.show', compact('category_menu', 'post', 'views', 'active', 'recent_posts', 'categories', 'popular_posts', 'post_related'));
//        return view('frontend.article.show', compact('post', 'views'));
    }
}
