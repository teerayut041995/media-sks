<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Post;
use App\Service;
use App\ServiceImage;
use Carbon\Carbon;
use App\Http\Helpers\HelperCore;

class ServiceController extends Controller
{
    public $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function index(Request $request)
    {
//        return 1;
        $category_menu = $this->helperCore->getCategoryMenu();

        if (empty($request->service_type)) {
            return redirect('/');
        }

        $services = Service::where('service_type', $request->service_type)
            ->where('services.service_status', 'active')
            ->orderBy('services.service_sequence', 'asc')
            ->leftJoin('service_images', function ($leftJoin) {
                $leftJoin->on('service_images.service_uid', '=', 'services.uid')
                    ->where('service_images.service_image_type', 'banner')
                    ->where('service_images.service_image_status', 'active')
                    ->limit(1);
            })
            ->select([
                'services.uid',
                'services.service_name',
                'services.service_type',
                'services.service_sequence',
                'services.service_status',
                'service_images.service_image_file_name'
            ])
            ->get();

//        return ['results' => $services];

        return view('frontend.service.index', compact('category_menu', 'services', 'request'));
    }

    public function show($service_uid)
    {
        $category_menu = $this->helperCore->getCategoryMenu();

        $service = Service::where('uid', $service_uid)->firstOrFail();
        $data_service_images = ServiceImage::where('service_uid', $service_uid)
            ->where('service_image_status', 'active')
            ->orderBy('service_image_sequence', 'ASC')->get();
        $service_images = collect($data_service_images);
        $image_banner = $service_images->where('service_image_type', 'banner')->first();
        $image_preview_1 = $service_images->where('service_image_type', 'preview_1')->first();
        $image_preview_2 = $service_images->where('service_image_type', 'preview_2')->first();
        $image_general = $service_images->where('service_image_type', 'general')->values();

        return view('frontend.service.show', compact('category_menu',  'service', 'image_banner', 'image_preview_1', 'image_preview_2', 'image_general'));
//        return view('frontend.article.show', compact('post', 'views'));
    }
}
