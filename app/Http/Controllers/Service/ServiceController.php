<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index(Request $request)
    {
        $services = Service::orderBy('services.service_sequence', 'ASC');

        if (!empty($request->service_status)) {
            $services = $services->where('services.service_status', $request->service_status);
        }

        if (!empty($request->name)) {
            $services = $services->where("services.service_name", "LIKE", "%{$request->name}%");
        }
        $services->select([
            'services.*',
        ]);

        $services = $services->paginate(15)->appends(request()->except('page'));

        return view('admin.service.index', compact('services', 'request'));
    }

    public function show($service_uid)
    {
        $service = Service::where('uid', $service_uid)->firstOrFail();
        $data_service_images = ServiceImage::where('service_uid', $service_uid)
            ->orderBy('service_image_sequence', 'ASC')->get();
        $service_images = collect($data_service_images);
        $image_banner = $service_images->where('service_image_type', 'banner')->first();
        $image_preview_1 = $service_images->where('service_image_type', 'preview_1')->first();
        $image_preview_2 = $service_images->where('service_image_type', 'preview_2')->first();
        $image_general = $service_images->where('service_image_type', 'general')->values();
        return view('admin.service.show', compact('service', 'image_banner', 'image_preview_1', 'image_preview_2', 'image_general'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function edit($service_uid)
    {
        $service = Service::where('uid', $service_uid)->firstOrFail();
        return view('admin.service.edit', compact('service'));
    }

    public function store(Request $request)
    {
        $generateId = generateId();
        $banner = Service::create([
            'uid' => $generateId,
            'service_name' => $request->service_name,
            'service_type' => $request->service_type,
            'service_description' => $request->service_description,
            'service_mission' => $request->service_mission,
            'service_learning_activity' => $request->service_learning_activity,
            'service_contact_phone_number' => $request->service_contact_phone_number,
            'service_contact_name' => $request->service_contact_name,
            'service_address' => $request->service_address,
            'service_embed_map' => $request->service_embed_map,
            'service_sequence' => $request->service_sequence,
            'service_status' => $request->service_status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }

    public function update(Request $request, $banner_uid)
    {
        $banner = Service::where('uid', $banner_uid)
            ->update([
                'service_name' => $request->service_name,
                'service_type' => $request->service_type,
                'service_description' => $request->service_description,
                'service_mission' => $request->service_mission,
                'service_learning_activity' => $request->service_learning_activity,
                'service_contact_phone_number' => $request->service_contact_phone_number,
                'service_contact_name' => $request->service_contact_name,
                'service_address' => $request->service_address,
                'service_embed_map' => $request->service_embed_map,
                'service_sequence' => $request->service_sequence,
                'service_status' => $request->service_status,
                'updated_by' => Auth::id(),
            ]);
        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }


    public function delete($service_uid)
    {
        $service_images = ServiceImage::where('service_uid', $service_uid)
            ->select('id', 'uid', 'service_uid')
            ->limit(2)
            ->get();
        if (count($service_images) > 0) {
            return response()->json(['message' => 'ไม่สามารถลบข้อมูลได้ มีรูปภาพแล้ว กรุณาลบรูปภาพก่อน', 'data' => []], 402);
        }

        $banner = Service::where('uid', $service_uid)
            ->forceDelete();
        return response()->json(['message' => 'ลบข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }
}
