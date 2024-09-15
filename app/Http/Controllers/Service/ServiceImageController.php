<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ServiceImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }


    public function create($service_uid)
    {
        $service = Service::where('uid', $service_uid)->firstOrFail();
        return view('admin.service.image.create', compact('service'));
    }

    public function edit($service_uid, $image_uid)
    {
        $service = Service::where('uid', $service_uid)->firstOrFail();
        $service_image = ServiceImage::where('uid', $image_uid)->where('service_uid', $service_uid)->firstOrFail();
        return view('admin.service.image.edit', compact('service', 'service_image'));
    }

    public function store(Request $request, $service_uid)
    {
        if (empty($request->file('service_image_file_name'))) {
            return response()->json(['message' => 'กรุณาอัพโหลดรูปภาพ', 'data' => []], 402);
        }

        $service_image_file_name = NULL;
        if ($request->service_image_type == 'banner') {
            return $service_image_file_name = $this->imageBanner($request, $service_uid);
        }

        if ($request->service_image_type == 'preview_1') {
            return $service_image_file_name = $this->imagePreview($request, $service_uid);
        }

        if ($request->service_image_type == 'preview_2') {
            return $service_image_file_name = $this->imagePreview($request, $service_uid);
        }

        if ($request->file('service_image_file_name') != '') {
            $file_image = $request->file('service_image_file_name');
            $service_image_file_name =  'general-'.md5(rand()*time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/service'), $service_image_file_name);
        } else {
            $service_image_file_name = "";
        }

        $generateId = generateId();
        $banner = ServiceImage::create([
            'uid' => $generateId,
            'service_uid' => $service_uid,
            'service_image_name' => $request->service_image_name,
            'service_image_file_name' => $service_image_file_name,
            'service_image_type' => $request->service_image_type,
            'service_image_description' => $request->service_image_description,
            'service_image_sequence' => $request->service_image_sequence,
            'service_image_status' => $request->service_image_status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }

    public function imageBanner($request, $service_uid)
    {
        $generateId = generateId();
        $service_image = ServiceImage::where('service_uid', $service_uid)
            ->where('service_image_type', 'banner')
            ->first();

        if ($request->file('service_image_file_name') != '') {
            $file_image = $request->file('service_image_file_name');
            $file_thumbnail = $request->file('service_image_file_name');
            $post_image_thumbnail_file_name = $this->uploadAndReSizeImage($file_thumbnail);
            $service_image_file_name = $post_image_thumbnail_file_name;
            $file_image->move(public_path('images/service'), $service_image_file_name);
        } else {
            $service_image_file_name = "";
        }

        if ($service_image) {
            @unlink(public_path() . '/images/service/' . $service_image->service_image_file_name);
            @unlink(public_path() . '/images/service/thumbnail/' . $service_image->service_image_file_name);
            $banner = ServiceImage::where('id', $service_image->id)
                ->update([
                'service_image_name' => $request->service_image_name,
                'service_image_file_name' => $service_image_file_name,
                'service_image_description' => $request->service_image_description,
                'service_image_sequence' => $request->service_image_sequence,
                'service_image_status' => $request->service_image_status,
                'updated_by' => Auth::id(),
            ]);
            return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
        }

        $banner = ServiceImage::create([
            'uid' => $generateId,
            'service_uid' => $service_uid,
            'service_image_name' => $request->service_image_name,
            'service_image_file_name' => $service_image_file_name,
            'service_image_type' => $request->service_image_type,
            'service_image_description' => $request->service_image_description,
            'service_image_sequence' => $request->service_image_sequence,
            'service_image_status' => $request->service_image_status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }

    public function imagePreview($request, $service_uid)
    {
        $generateId = generateId();
        $service_image = ServiceImage::where('service_uid', $service_uid)
            ->where('service_image_type', $request->service_image_type)
            ->first();

        if ($request->file('service_image_file_name') != '') {
            $file_image = $request->file('service_image_file_name');
            $service_image_file_name =  $request->service_image_type. '-' . md5(rand()*time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/service'), $service_image_file_name);
        } else {
            $service_image_file_name = "";
        }

        if ($service_image) {
            @unlink(public_path() . '/images/service/' . $service_image->service_image_file_name);
            $banner = ServiceImage::where('id', $service_image->id)
                ->update([
                    'service_image_name' => $request->service_image_name,
                    'service_image_file_name' => $service_image_file_name,
                    'service_image_description' => $request->service_image_description,
                    'service_image_sequence' => $request->service_image_sequence,
                    'service_image_status' => $request->service_image_status,
                    'updated_by' => Auth::id(),
                ]);
            return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
        }

        $banner = ServiceImage::create([
            'uid' => $generateId,
            'service_uid' => $service_uid,
            'service_image_name' => $request->service_image_name,
            'service_image_file_name' => $service_image_file_name,
            'service_image_type' => $request->service_image_type,
            'service_image_description' => $request->service_image_description,
            'service_image_sequence' => $request->service_image_sequence,
            'service_image_status' => $request->service_image_status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }

    public function update(Request $request, $service_uid, $image_uid)
    {

        $service_image = ServiceImage::where('uid', $image_uid)->where('service_uid', $service_uid)->firstOrFail();

        if ($service_image->service_image_type == 'banner') {

            $service_image_file_name = $request->old_service_image_file_name;
            if ($request->file('service_image_file_name') != '')  {
                $image_post = $request->file('service_image_file_name');
                $file_thumbnail = $request->file('service_image_file_name');
                $service_image_file_name = $this->uploadAndReSizeImage($file_thumbnail);
                $image_name = $service_image_file_name;
                $image_post->move(public_path('images/service'), $image_name);
                if ($request->old_service_image_file_name != '') {
                    @unlink(public_path() . '/images/service/' . $request->old_service_image_file_name);
                    @unlink(public_path() . '/images/service/thumbnail/' . $request->old_service_image_file_name);
                }
            }

            $banner = ServiceImage::where('id', $service_image->id)
                ->update([
                    'service_image_name' => $request->service_image_name,
                    'service_image_file_name' => $service_image_file_name,
                    'service_image_description' => $request->service_image_description,
                    'service_image_sequence' => $request->service_image_sequence,
                    'service_image_status' => $request->service_image_status,
                    'updated_by' => Auth::id(),
                ]);

            return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
        }

        $service_image_file_name = $request->old_service_image_file_name;
        if ($request->file('service_image_file_name') != '') {
            $file_image = $request->file('service_image_file_name');
            $service_image_file_name =  'general-'.md5(rand()*time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/service'), $service_image_file_name);
            if ($request->old_service_image_file_name != '') {
                @unlink(public_path() . '/images/service/' . $request->old_service_image_file_name);
            }
        }

        $banner = ServiceImage::where('id', $service_image->id)
            ->update([
            'service_image_name' => $request->service_image_name,
            'service_image_file_name' => $service_image_file_name,
            'service_image_description' => $request->service_image_description,
            'service_image_sequence' => $request->service_image_sequence,
            'service_image_status' => $request->service_image_status,
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }

    public function delete($service_uid, $image_uid)
    {
        $service = ServiceImage::where('service_uid', $service_uid)
            ->where('uid', $image_uid)
            ->firstOrFail();
        if ($service->service_image_file_name) {
            @unlink(public_path() . '/images/service/' . $service->service_image_file_name);
            @unlink(public_path() . '/images/service/thumbnail/' . $service->service_image_file_name);
        }

        $service = ServiceImage::where('service_uid', $service_uid)
            ->where('uid', $image_uid)
            ->forceDelete();

        return response()->json(['message' => 'ลบข้อมูลเรียบร้อยแล้ว', 'data' => $service], 201);
    }

    public function uploadAndReSizeImage($file) {
        $name = 'banner-' . md5(rand()*time()).'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('images/service/thumbnail');
        $img = Image::make($file->path());
        $img->resize(630, 315, function ($constraint) {
//            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$name);
        return $name;
    }
}
