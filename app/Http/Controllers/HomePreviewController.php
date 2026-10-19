<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\PreviewMenu;

class HomePreviewController extends Controller
{
    public function index(Request $request)
    {
        // A frozen public-content fixture: no models, sessions or live API calls.
        $content = $this->content();
        $records = $content['records'];
        $byId = array_column($records, null, 'id');
        $pick = function (array $ids) use ($byId) {
            return array_map(function ($id) use ($byId) {
                return $byId[$id];
            }, $ids);
        };

        $featured = $byId['4712334485356745'];
        $latest = $pick($content['home']['latest']);
        $awards = $pick($content['home']['awards']);
        $events = $pick($content['home']['events']);
        $documents = $pick($content['home']['documents']);

        $rawQuery = $request->query('q', '');
        $query = is_string($rawQuery) ? mb_substr(trim($rawQuery), 0, 120) : '';
        $matches = [];

        if ($query !== '') {
            foreach ($records as $record) {
                $titleMatch = mb_stripos($record['title'], $query);
                if ($titleMatch !== false || mb_stripos($record['summary'], $query) !== false) {
                    $record['rank'] = $titleMatch !== false ? 0 : 1;
                    $matches[] = $record;
                }
            }
            usort($matches, function ($a, $b) {
                return ($a['rank'] <=> $b['rank'])
                    ?: strcmp($b['date'], $a['date'])
                    ?: strcmp($a['id'], $b['id']);
            });
        }

        $total = count($matches);
        $pages = max(1, (int) ceil($total / 12));
        $rawPage = $request->query('page', 1);
        $page = is_scalar($rawPage) ? max(1, min($pages, (int) $rawPage)) : 1;
        $results = array_slice($matches, ($page - 1) * 12, 12);
        $category_menu = PreviewMenu::all();
        $aboutPage = 'home';
        $aboutPreview = true;
        $publicCanonical = url('/');

        return response()->view('frontend.home.public', compact(
            'content', 'featured', 'latest', 'awards', 'events', 'documents',
            'query', 'total', 'pages', 'page', 'results',
            'category_menu', 'aboutPage', 'aboutPreview', 'publicCanonical'
        ))->header('X-Robots-Tag', 'noindex, nofollow')
          ->header('Cache-Control', 'no-store');
    }

    public function show($kind, $id)
    {
        $content = $this->content();
        $byId = array_column($content['records'], null, 'id');
        $article = $byId[$id] ?? null;
        abort_unless($article && parse_url($article['url'], PHP_URL_PATH) === '/'.$kind.'/'.$id, 404);

        $related = array_values(array_filter($content['records'], function ($record) use ($article) {
            return $record['id'] !== $article['id'] && $record['type'] === $article['type']
                && $record['preview_url'] !== $record['url'];
        }));
        usort($related, function ($a, $b) {
            return strcmp($b['date'], $a['date']) ?: strcmp($a['id'], $b['id']);
        });
        $related = array_slice($related, 0, 3);

        return response()->view('frontend.preview.content', compact('article', 'kind', 'related'))
            ->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
    }

    private function content()
    {
        $content = json_decode(file_get_contents(resource_path('data/home-preview.json')), true);
        foreach ($content['records'] as &$record) {
            $path = parse_url($record['url'], PHP_URL_PATH);
            if (preg_match('~^/events/([0-9]+)$~', $path, $eventMatch)) {
                $record['preview_url'] = route('preview.events.show', ['event_uid' => $eventMatch[1]]);
            } else {
                $record['preview_url'] = preg_match('~^/posts/([0-9]+)$~', $path, $match)
                    ? route('preview.content', ['kind' => 'posts', 'id' => $match[1]]) : $record['url'];
            }
            if (preg_match('~^/about/(history|executive)$~', $path, $aboutMatch)) {
                $record['preview_url'] = route('preview.about', ['page' => $aboutMatch[1]]);
            }
        }
        unset($record);
        return $content;
    }
}
