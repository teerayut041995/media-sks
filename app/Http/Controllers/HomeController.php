<?php

namespace App\Http\Controllers;

use App\Http\Helpers\HelperCore;
use App\Services\PublicHomeContent;
use Illuminate\Http\Request;

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
        $rawQuery = $request->query('q', $request->query('name', ''));
        $query = is_string($rawQuery) ? mb_substr(trim($rawQuery), 0, 120) : '';
        $rawPage = $request->query('page', 1);
        $page = is_scalar($rawPage) ? max(1, (int) $rawPage) : 1;

        $homeData = (new PublicHomeContent())->homepage($category_menu, $query, $page);
        $aboutPage = 'home';
        $aboutPreview = false;
        $publicCanonical = url('/');

        return view('frontend.home.public', array_merge($homeData, compact(
            'category_menu', 'aboutPage', 'aboutPreview', 'publicCanonical'
        )));
    }
}
