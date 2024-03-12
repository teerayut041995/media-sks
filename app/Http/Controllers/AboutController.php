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
        return view('frontend.about.history', compact('category_menu'));
    }

    public function executive()
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        return view('frontend.about.executive', compact('category_menu'));
    }

    public function contact()
    {
        $category_menu = $this->helperCore->getCategoryMenu();
        return view('frontend.about.contact', compact('category_menu'));
    }


}
