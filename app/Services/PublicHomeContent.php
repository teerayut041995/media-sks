<?php

namespace App\Services;

use App\Banner;
use App\Event;
use App\Post;
use Illuminate\Support\Facades\DB;

class PublicHomeContent
{
    const SEARCH_PAGE_SIZE = 12;

    public function homepage($categoryMenu, $query, $requestedPage)
    {
        $news = $this->postsForCategory($categoryMenu, 'ประชาสัมพันธ์', 7);
        $featured = $news->first();
        $latest = $news->slice(1)->values()->all();
        $awards = $this->postsForCategory($categoryMenu, 'รางวัลและผลงาน', 3)->all();

        $events = Event::where('publishing_status', '1')
            ->orderBy('event_date', 'desc')->orderBy('created_at', 'desc')
            ->select('uid', 'event_name', 'event_image', 'event_date', 'created_at')
            ->limit(3)->get()->map(function ($event) {
                $date = $event->event_date ?: $event->created_at;
                return [
                    'id' => (string) $event->uid,
                    'title' => $event->event_name,
                    'image' => $this->imageUrl('images/image_event', $event->event_image),
                    'date' => $this->dateValue($date),
                    'display_date' => $date ? formatDateThaiBirthday($date) : '',
                    'preview_url' => url('/events/'.$event->uid),
                ];
            })->all();

        $downloadCategoryId = $this->categoryId($categoryMenu, 'ดาวน์โหลด');
        $documents = [];
        if ($downloadCategoryId) {
            $document = Post::where('post_status', '1')
                ->where('category_id', $downloadCategoryId)
                ->orderBy('created_at', 'desc')->select('uid', 'post_title')->first();
            if ($document) {
                $documents[] = ['title' => $document->post_title, 'url' => url('/posts/'.$document->uid)];
            }
        }

        $banners = Banner::where('banner_status', 'active')
            ->whereNotNull('banner_file_name')->where('banner_file_name', '!=', '')
            ->orderBy('banner_sequence', 'asc')
            ->select('banner_name', 'banner_file_name', 'banner_first_link')
            ->get()->map(function ($banner) {
                return [
                    'image' => $this->imageUrl('images/banner', $banner->banner_file_name),
                    'alt' => $banner->banner_name ?: 'ประกาศจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์',
                    'background' => '#edf5fb',
                    'url' => $this->bannerUrl($banner->banner_first_link),
                ];
            })->values()->all();

        $search = $query === '' ? ['results' => [], 'total' => 0, 'page' => 1, 'pages' => 1]
            : $this->search($query, $requestedPage);

        return array_merge($search, [
            'content' => ['home' => ['banners' => $banners]],
            'featured' => $featured,
            'latest' => $latest,
            'awards' => $awards,
            'events' => $events,
            'documents' => $documents,
            'query' => $query,
        ]);
    }

    private function categoryId($categoryMenu, $name)
    {
        $category = collect($categoryMenu)->first(function ($item) use ($name) {
            return data_get($item, 'category_name') === $name;
        });
        return $category ? data_get($category, 'id') : null;
    }

    private function postsForCategory($categoryMenu, $name, $limit)
    {
        $categoryId = $this->categoryId($categoryMenu, $name);
        if (!$categoryId) return collect();

        return Post::where('post_status', '1')->where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->select('uid', 'post_title', 'post_image', 'post_image_thumbnail_file_name', 'created_at')
            ->limit($limit)->get()->map(function ($post) use ($name) {
                return $this->postCard($post, $name);
            });
    }

    private function postCard($post, $categoryName)
    {
        $date = $post->created_at;
        $image = $this->imageUrl('images/image_post', $post->post_image);
        $thumbnail = $this->imageUrl('images/image_post/thumbnail', $post->post_image_thumbnail_file_name) ?: $image;
        return [
            'id' => (string) $post->uid,
            'type' => $categoryName,
            'title' => $post->post_title,
            'summary' => '',
            'date' => $this->dateValue($date),
            'display_date' => $date ? formatDateThaiBirthday($date) : '',
            'image' => $image,
            'thumbnail' => $thumbnail,
            'preview_url' => url('/posts/'.$post->uid),
        ];
    }

    private function search($query, $requestedPage)
    {
        $like = '%'.$query.'%';
        $posts = DB::table('posts')->join('categories', 'categories.id', '=', 'posts.category_id')
            ->selectRaw($this->searchColumns(
                'posts.uid', 'posts.post_title', 'posts.post_detail', 'posts.created_at',
                'categories.category_name', "'posts'"
            ))
            ->selectRaw('CASE WHEN posts.post_title LIKE ? THEN 0 ELSE 1 END as match_rank', [$like])
            ->where('posts.post_status', '1')
            ->where(function ($builder) use ($like) {
                $builder->where('posts.post_title', 'LIKE', $like)->orWhere('posts.post_detail', 'LIKE', $like);
            });
        $events = DB::table('events')
            ->selectRaw($this->searchColumns(
                'events.uid', 'events.event_name', 'events.event_description', 'events.created_at',
                "'กิจกรรม'", "'events'"
            ))
            ->selectRaw('CASE WHEN events.event_name LIKE ? THEN 0 ELSE 1 END as match_rank', [$like])
            ->where('events.publishing_status', '1')
            ->where(function ($builder) use ($like) {
                $builder->where('events.event_name', 'LIKE', $like)->orWhere('events.event_description', 'LIKE', $like);
            });
        $services = DB::table('services')
            ->selectRaw($this->searchColumns(
                'services.uid', 'services.service_name', 'services.service_description', 'services.created_at',
                "'หน่วยบริการ'", "'services'"
            ))
            ->selectRaw('CASE WHEN services.service_name LIKE ? THEN 0 ELSE 1 END as match_rank', [$like])
            ->where('services.service_status', 'active')
            ->where(function ($builder) use ($like) {
                $builder->where('services.service_name', 'LIKE', $like)->orWhere('services.service_description', 'LIKE', $like);
            });

        $union = $posts->unionAll($events)->unionAll($services);
        $table = DB::raw('('.$union->toSql().') as public_search');
        // Query Builder's count() drops SELECT bindings, including the match
        // expressions inside this UNION, so count the derived table directly.
        $total = (int) DB::table($table)->mergeBindings($union)->selectRaw('COUNT(*) as total')->first()->total;
        $pages = max(1, (int) ceil($total / self::SEARCH_PAGE_SIZE));
        $page = max(1, min($pages, $requestedPage));
        $matches = DB::table($table)->mergeBindings($union)
            ->orderBy('match_rank')->orderBy('published_at', 'desc')->orderBy('id')
            ->offset(($page - 1) * self::SEARCH_PAGE_SIZE)->limit(self::SEARCH_PAGE_SIZE)->get();
        $results = $matches->map(function ($match) {
            $date = $match->published_at;
            return [
                'id' => (string) $match->id,
                'type' => $match->type,
                'title' => $match->title,
                'summary' => str_limit($this->plainText($match->summary), 210),
                'date' => $this->dateValue($date),
                'display_date' => $date ? formatDateThaiBirthday($date) : '',
                'preview_url' => url('/'.$match->kind.'/'.$match->id),
            ];
        })->all();
        return compact('results', 'total', 'pages', 'page');
    }

    private function imageUrl($folder, $filename)
    {
        if (!$filename) return null;
        $path = $folder.'/'.basename($filename);
        return is_file(public_path($path)) ? asset($path) : 'https://sks.go.th/'.$path;
    }

    private function searchColumns($id, $title, $summary, $published, $type, $kind)
    {
        return implode(', ', [
            $this->compatibleText($id).' as id',
            $this->compatibleText($title).' as title',
            $this->compatibleText($summary).' as summary',
            $published.' as published_at',
            $this->compatibleText($type).' as type',
            $this->compatibleText($kind).' as kind',
        ]);
    }

    private function compatibleText($expression)
    {
        // Legacy tables use different MySQL collations. Normalizing the UNION
        // output avoids a cross-table collation error during public search.
        return DB::getDriverName() === 'mysql'
            ? 'CONVERT('.$expression.' USING utf8mb4) COLLATE utf8mb4_unicode_ci'
            : $expression;
    }

    private function bannerUrl($link)
    {
        if (!is_string($link) || $link === '') return null;
        if (strpos($link, '/') === 0 && strpos($link, '//') !== 0) return url($link);
        $scheme = parse_url($link, PHP_URL_SCHEME);
        return in_array($scheme, ['http', 'https'], true) && filter_var($link, FILTER_VALIDATE_URL) ? $link : null;
    }

    private function dateValue($date)
    {
        return $date ? substr((string) $date, 0, 10) : '';
    }

    private function plainText($html)
    {
        return trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    }
}
