<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Post;
use App\Http\Helpers\HelperCore;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Support\PreviewMenu;

class ArticleController extends Controller
{
    public $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function category(Request $request, $slug)
    {
        $category = Category::where('category_status', '1')
            ->where('category_slug', $slug)
            ->firstOrFail();
        $request->merge(['category' => $category->uid]);
        return $this->index($request);
    }

    public function sub_category(Request $request, $cate_slug, $sub_slug)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $recent_posts = $this->helperCore->recentPosts(4);
        $popular_posts = $this->helperCore->popularPosts(4);
        $categories = $this->helperCore->getCategories();
        $sub_categories = $this->helperCore->getSubCategories();
        $active = array('name' => '');
        $category = SubCategory::join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.id', 'sub_categories.sub_category_name', 'sub_categories.sub_category_slug', 'categories.category_name', 'categories.category_slug')
            ->where('categories.category_status', '1')
            ->where('categories.category_slug', $cate_slug)
            ->where('sub_categories.sub_category_status', '1')
            ->where('sub_categories.sub_category_slug', $sub_slug)
            ->firstOrFail();

        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id',
                'posts.post_title', 'posts.post_slug', 'posts.post_image', 'posts.post_detail', 'posts.post_status', 'posts.created_at',
                'users.name'
            ])
            ->where('posts.post_status', '1')
            ->where('posts.sub_category_id', $category->id)
            ->orderBy('posts.created_at', 'DESC');
        $rawSearch = $request->query('name', '');
        $search = is_string($rawSearch) ? mb_substr(trim($rawSearch), 0, 120) : '';
        if ($search !== '') {
            $posts->where(function ($query) use ($search) {
                $query->where('posts.post_title', 'LIKE', '%'.$search.'%')
                    ->orWhere('posts.post_detail', 'LIKE', '%'.$search.'%');
            });
            $active['name'] = $search;
        }
        $posts = $posts->paginate(12)->appends(request()->except('page'));
        return view('frontend.article.sub-category', compact('category_menu', 'category', 'posts', 'active', 'recent_posts', 'categories', 'sub_categories', 'popular_posts'));
    }

    public function index(Request $request)
    {
        if (!$request->filled('category')) {
            return redirect('/');
        }
        $category_menu = $this->helperCore->getCategoryMenu();
        $category = Category::where('uid', $request->input('category'))
            ->where('category_status', '1')
            ->select('id', 'uid', 'category_name')
            ->firstOrFail();
        $sub_category = null;
        $posts = Post::leftJoin('users', 'posts.user_id', 'users.id')
            ->select([
                'posts.id', 'posts.uid', 'posts.user_id', 'posts.category_id', 'posts.sub_category_id',
                'posts.post_title', 'posts.post_slug', 'posts.post_image', 'posts.post_detail', 'posts.created_at',
                'users.name'
            ])
            ->where('posts.post_status', '1')
            ->where('posts.category_id', $category->id)
            ->orderBy('posts.created_at', 'DESC');
        if ($request->filled('sub_category')) {
            $sub_category = SubCategory::where('uid', $request->input('sub_category'))
                ->where('category_id', $category->id)
                ->where('sub_category_status', '1')
                ->select('id', 'uid', 'sub_category_name')
                ->firstOrFail();
            $posts->where('posts.sub_category_id', $sub_category->id);
        }
        $rawSearch = $request->input('name', '');
        $search = is_string($rawSearch) ? mb_substr(trim($rawSearch), 0, 120) : '';
        if ($search !== '') {
            $posts->where(function ($query) use ($search) {
                $query->where('posts.post_title', 'LIKE', '%'.$search.'%')
                    ->orWhere('posts.post_detail', 'LIKE', '%'.$search.'%');
            });
        }
        $posts = $posts->paginate(12)->appends(request()->except('page'));
        return $this->renderIndex($category_menu, $category, $sub_category, $posts, $search);
    }

    public function previewIndex(Request $request)
    {
        $category_menu = PreviewMenu::all();
        $category = $category_menu->first(function ($item) use ($request) {
            return $item['uid'] === $request->input('category');
        });
        abort_unless($category, 404);
        $sub_category = null;
        if ($request->filled('sub_category')) {
            $sub_category = collect($category['sub_categories'])->first(function ($item) use ($request) {
                return $item['uid'] === $request->input('sub_category');
            });
            abort_unless($sub_category, 404);
        }
        $rawSearch = $request->input('name', '');
        $search = is_string($rawSearch) ? mb_substr(trim($rawSearch), 0, 120) : '';
        $snapshot = json_decode(file_get_contents(resource_path('data/home-preview.json')), true);
        $newsSample = ['4712334485356745', '2448482059092676', '2676572962299823', '8734159223280636', '4880908304262960', '8372667123393814', '5200260212700590', '3311431076790247', '6039529078197292', '8654182682443802', '6305768376339372', '2613435774246288'];
        $records = collect($snapshot['records'])->filter(function ($record) use ($category, $sub_category, $newsSample) {
            if ($record['type'] !== $category['category_name']) return false;
            if (!$sub_category) return true;
            return $sub_category['uid'] === '6953297868715565' && in_array($record['id'], $newsSample, true);
        })->map(function ($record) {
            return (object) [
                'uid' => $record['id'], 'post_title' => $record['title'],
                'post_detail' => $record['summary'], 'post_image' => basename(parse_url($record['image'], PHP_URL_PATH)),
                'created_at' => $record['date'],
            ];
        })->sortByDesc('created_at')->values();
        if ($search !== '') {
            $records = $records->filter(function ($record) use ($search) {
                return mb_stripos($record->post_title, $search) !== false || mb_stripos($record->post_detail, $search) !== false;
            })->values();
        }
        $page = max(1, (int) $request->input('page', 1));
        $posts = new LengthAwarePaginator($records->forPage($page, 12)->values(), $records->count(), 12, $page, ['path' => route('preview.posts')]);
        $posts->appends($request->except('page'));
        return $this->renderIndex($category_menu, (object) $category, $sub_category ? (object) $sub_category : null, $posts, $search, true);
    }

    private function renderIndex($category_menu, $category, $sub_category, $posts, $search, $aboutPreview = false)
    {
        $aboutPage = 'posts';
        $publicCanonical = url('/posts').'?'.http_build_query(array_filter([
            'category' => $category->uid, 'sub_category' => $sub_category->uid ?? null,
        ]));
        $response = response()->view('frontend.article.index', compact(
            'category_menu', 'category', 'sub_category', 'posts', 'search', 'aboutPage', 'aboutPreview', 'publicCanonical'
        ));
        if ($aboutPreview) $response->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
        return $response;
    }

    public function show($post_uid)
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        $post = Post::join('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'posts.sub_category_id', 'sub_categories.id')
            ->leftJoin('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'categories.uid as category_uid', 'categories.category_name', 'sub_categories.uid as sub_category_uid', 'sub_categories.sub_category_name', 'users.name')
            ->where('posts.post_status', '1')
            ->where('posts.uid', $post_uid)
            ->firstOrFail();
        $expiresAt = now()->addHours(24);
        views($post)
            ->delayInSession($expiresAt)
            ->record();
        $views = views($post)->count();

        $post_related = Post::where('posts.post_status', '1')
            ->where('posts.category_id', $post->category_id)
            ->where('posts.id', '!=', $post->id)
            ->when($post->sub_category_id, function ($query) use ($post) {
                return $query->where('posts.sub_category_id', $post->sub_category_id);
            })
            ->select(['posts.uid', 'posts.post_title', 'posts.post_detail', 'posts.created_at', 'posts.post_image'])
            ->orderBy('posts.created_at', 'DESC')
            ->limit(3)
            ->get();
        $recent_posts = $this->helperCore->recentPosts(5)
            ->reject(function ($recent) use ($post) { return (string) $recent->uid === (string) $post->uid; })
            ->take(4)->values();
        $popular_posts = $this->helperCore->popularPosts(4);
        return $this->renderShow($category_menu, $post, $post_related, $recent_posts, $popular_posts, $views);
    }

    public function previewShow($post_uid)
    {
        $snapshot = json_decode(file_get_contents(resource_path('data/home-preview.json')), true);
        $record = collect($snapshot['records'])->first(function ($item) use ($post_uid) {
            return $item['type'] === 'ประชาสัมพันธ์' && $item['id'] === $post_uid;
        });
        abort_unless($record, 404);

        $category_menu = PreviewMenu::all();
        $category = $category_menu->first(function ($item) use ($record) {
            return $item['category_name'] === $record['type'];
        });
        $post = (object) [
            'uid' => $record['id'],
            'post_title' => $record['title'],
            'post_detail' => $record['paragraphs'][0] ?? $record['summary'],
            'post_content' => collect($record['paragraphs'])->slice(1)->map(function ($paragraph) {
                return '<p>'.e($paragraph).'</p>';
            })->implode(''),
            'post_image' => basename(parse_url($record['image'], PHP_URL_PATH)),
            'post_image_thumbnail_file_name' => !empty($record['thumbnail']) ? basename(parse_url($record['thumbnail'], PHP_URL_PATH)) : null,
            'post_youtube_embed' => null,
            'created_at' => $record['date'],
            'name' => 'งานประชาสัมพันธ์ ศกศ.กส',
            'category_name' => $record['type'],
            'category_uid' => $category['uid'] ?? null,
            'sub_category_name' => 'ข่าวสาร',
            'sub_category_uid' => '6953297868715565',
        ];
        $post_related = collect($snapshot['records'])->filter(function ($item) use ($record) {
            return $item['type'] === $record['type'] && $item['id'] !== $record['id'];
        })->sortByDesc('date')->take(3)->map(function ($item) {
            return (object) [
                'uid' => $item['id'], 'post_title' => $item['title'],
                'post_detail' => $item['summary'], 'created_at' => $item['date'],
                'post_image' => basename(parse_url($item['image'], PHP_URL_PATH)),
            ];
        })->values();

        $snapshotPosts = collect($snapshot['records'])->keyBy('id');
        $recent_posts = collect(['4712334485356745', '2448482059092676', '2676572962299823', '8734159223280636'])
            ->map(function ($uid) use ($snapshotPosts) { return $snapshotPosts->get($uid); })
            ->filter(function ($item) use ($post_uid) { return $item && $item['id'] !== $post_uid; })
            ->map(function ($item) { return $this->previewSidebarPost($item); })->values();
        $popularCounts = ['2596715526463527' => 82451, '6478218850732802' => 11988,
            '6425555243593245' => 5392, '5042193433380031' => 3267];
        $popular_posts = collect($popularCounts)->map(function ($count, $uid) use ($snapshotPosts) {
            $item = $snapshotPosts->get((string) $uid);
            return $item ? $this->previewSidebarPost($item, $count) : null;
        })->filter()->values();

        return $this->renderShow($category_menu, $post, $post_related, $recent_posts, $popular_posts, null, true)
            ->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
    }

    private function previewSidebarPost($record, $viewsCount = null)
    {
        return (object) [
            'uid' => $record['id'], 'post_title' => $record['title'],
            'post_image' => basename(parse_url($record['image'], PHP_URL_PATH)),
            'created_at' => $record['date'], 'views_count' => $viewsCount,
        ];
    }

    private function renderShow($category_menu, $post, $post_related, $recent_posts, $popular_posts, $views, $aboutPreview = false)
    {
        $aboutPage = 'posts';
        $category = (object) ['uid' => $post->category_uid];
        $sub_category = !empty($post->sub_category_uid) ? (object) ['uid' => $post->sub_category_uid] : null;
        $articleDetail = true;
        $publicArticle = true;
        $publicCanonical = url('/posts/'.$post->uid);
        $imageName = !empty($post->post_image_thumbnail_file_name) ? $post->post_image_thumbnail_file_name : $post->post_image;
        $imageFolder = !empty($post->post_image_thumbnail_file_name) ? 'images/image_post/thumbnail/' : 'images/image_post/';
        $publicOgImage = $imageName ? url($imageFolder.basename($imageName)) : null;
        return response()->view('frontend.article.show', compact(
            'category_menu', 'category', 'sub_category', 'post', 'post_related', 'recent_posts', 'popular_posts', 'views', 'aboutPreview', 'aboutPage',
            'articleDetail', 'publicArticle', 'publicCanonical', 'publicOgImage'
        ));
    }
}
