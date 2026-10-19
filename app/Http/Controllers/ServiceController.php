<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\ServiceImage;
use App\Http\Helpers\HelperCore;
use App\Support\PreviewMenu;

class ServiceController extends Controller
{
    public $helperCore;

    public function __construct()
    {
        $this->helperCore = new HelperCore();
    }

    public function index(Request $request)
    {
        $category_menu = $this->helperCore->getCategoryMenu();

        if (empty($request->service_type)) {
            return redirect('/');
        }

        $services = Service::where('service_type', $request->service_type)
            ->where('services.service_status', 'active')
            ->orderBy('services.service_sequence', 'asc')
            ->select([
                'services.uid',
                'services.service_name',
                'services.service_type',
                'services.service_sequence',
                'services.service_status',
            ])
            ->get();

        if ($services->isNotEmpty()) {
            $banners = ServiceImage::whereIn('service_uid', $services->pluck('uid')->all())
                ->where('service_image_type', 'banner')
                ->where('service_image_status', 'active')
                ->orderBy('service_image_sequence')->orderBy('id')
                ->get(['service_uid', 'service_image_file_name'])
                ->unique('service_uid')->keyBy('service_uid');

            $services->each(function ($service) use ($banners) {
                $banner = $banners->get($service->uid);
                $service->service_image_file_name = $banner ? $banner->service_image_file_name : null;
            });
        }

        return $this->renderIndex($request->service_type, $category_menu, $services);
    }

    public function previewIndex(Request $request)
    {
        $serviceType = $request->query('service_type', 'service_unit');
        abort_unless($serviceType === 'service_unit', 404);

        // The preview renders the real listing view with a public snapshot and no DB access.
        $category_menu = PreviewMenu::all();
        $services = collect(json_decode(file_get_contents(resource_path('data/service-unit-preview.json'))));
        return $this->renderIndex($serviceType, $category_menu, $services, true);
    }

    private function renderIndex($serviceType, $category_menu, $services, $servicePreview = false)
    {
        $serviceTitle = findServiceType($serviceType);
        $aboutPage = 'services';
        $aboutPreview = $servicePreview;
        $publicCanonical = url('/services?service_type='.rawurlencode($serviceType));
        $response = response()->view('frontend.service.index', compact(
            'category_menu', 'services', 'serviceType', 'serviceTitle',
            'servicePreview', 'aboutPage', 'aboutPreview', 'publicCanonical'
        ));
        if ($servicePreview) {
            $response->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
        }
        return $response;
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

        return $this->renderShow($service, $category_menu, $image_banner, $image_preview_1, $image_preview_2, $image_general);
    }

    public function previewShow($service_uid)
    {
        $snapshot = json_decode(file_get_contents(resource_path('data/service-detail-preview.json')));
        abort_unless($snapshot && $snapshot->service->uid === $service_uid, 404);

        $category_menu = PreviewMenu::all();
        $images = collect($snapshot->images);
        return $this->renderShow(
            $snapshot->service, $category_menu,
            $images->where('service_image_type', 'banner')->first(),
            $images->where('service_image_type', 'preview_1')->first(),
            $images->where('service_image_type', 'preview_2')->first(),
            $images->where('service_image_type', 'general')->values(), true
        );
    }

    private function renderShow($service, $category_menu, $image_banner, $image_preview_1, $image_preview_2, $image_general, $servicePreview = false)
    {
        $aboutPage = 'services';
        $aboutPreview = $servicePreview;
        $serviceType = $service->service_type;
        $serviceDetail = true;
        $publicCanonical = url('/services/'.$service->uid);
        $publicOgImage = null;
        if ($image_banner && $image_banner->service_image_file_name) {
            $imagePath = 'images/service/thumbnail/'.basename($image_banner->service_image_file_name);
            $publicOgImage = is_file(public_path($imagePath)) ? asset($imagePath) : 'https://sks.go.th/'.$imagePath;
        }

        $response = response()->view('frontend.service.show', compact(
            'category_menu', 'service', 'image_banner', 'image_preview_1', 'image_preview_2', 'image_general',
            'aboutPage', 'aboutPreview', 'serviceType', 'serviceDetail', 'publicCanonical', 'publicOgImage'
        ));
        if ($servicePreview) {
            $response->header('X-Robots-Tag', 'noindex, nofollow')->header('Cache-Control', 'no-store');
        }
        return $response;
    }
}
