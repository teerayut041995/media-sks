<?php

namespace App\Http\Controllers;

use App\Http\Helpers\HelperCore;
use App\Support\PreviewMenu;

class AboutController extends Controller
{
    public $helperCore;
    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function history()
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        return $this->renderAbout('history', $category_menu);
    }

    public function executive()
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        return $this->renderAbout('executive', $category_menu);
    }

    public function contact()
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        return $this->renderAbout('contact', $category_menu);
    }

    public function previewContact()
    {
        return $this->preview('contact');
    }

    public function preview($page)
    {
        abort_unless(in_array($page, ['history', 'executive', 'contact'], true), 404);
        // Visual QA uses the real views, with a frozen menu instead of a DB query.
        return $this->renderAbout($page, PreviewMenu::all(), true);
    }

    private function renderAbout($aboutPage, $category_menu, $aboutPreview = false)
    {
        $about = json_decode(file_get_contents(resource_path('data/about-pages.json')), true);
        $response = response()->view('frontend.about.'.$aboutPage, compact(
            'about', 'aboutPage', 'category_menu', 'aboutPreview'
        ));
        if ($aboutPreview) {
            $response->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
        }
        return $response;
    }
}
