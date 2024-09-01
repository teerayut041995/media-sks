<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }

    public function index(Request $request)
    {
        $banners = Banner::orderBy('banners.banner_status', 'ASC')
            ->orderBy('banners.banner_sequence', 'ASC');

        if (!empty($request->banner_status)) {
            $banners = $banners->where('banners.banner_status', $request->banner_status);
        }

        if (!empty($request->name)) {
            $banners = $banners->where("banners.banner_name", "LIKE", "%{$request->name}%");
        }
        $banners->select([
            'banners.*',
        ]);

       $banners = $banners->paginate(15)->appends(request()->except('page'));

        return view('admin.banner.index', compact('banners', 'request'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function edit($banner_uid)
    {
        $banner = Banner::where('uid', $banner_uid)->firstOrFail();
        return view('admin.banner.edit', compact('banner'));
    }

    public function store(Request $request)
    {
        $generateId = generateId();
        $banner_file_name = NULL;
        if ($request->hasFile('banner_file_name')) {
            $file_image = $request->file('banner_file_name');
            $banner_file_name = md5(rand() * time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/banner'), $banner_file_name);
        }

        $banner = Banner::create([
            'uid' => $generateId,
            'banner_name' => $request->banner_name,
            'banner_file_name' => $banner_file_name,
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
            'banner_first_link' => $request->banner_first_link,
            'banner_first_link_text' => $request->banner_first_link_text,
            'banner_second_link' => $request->banner_second_link,
            'banner_second_link_text' => $request->banner_second_link_text,
            'banner_sequence' => $request->banner_sequence,
            'banner_status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }

    public function update(Request $request, $banner_uid)
    {
        $banner_file_name = $request->old_banner_file_name;
        if ($request->hasFile('banner_file_name')) {
            $file = $request->file('banner_file_name');
            $banner_file_name = md5(rand() * time()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/banner'), $banner_file_name);
            @unlink(public_path() . '/images/banner/' . $request->old_banner_file_name);
        }

        $banner = Banner::where('uid', $banner_uid)
            ->update([
                'banner_name' => $request->banner_name,
                'banner_file_name' => $banner_file_name,
                'banner_title' => $request->banner_title,
                'banner_description' => $request->banner_description,
                'banner_first_link' => $request->banner_first_link,
                'banner_first_link_text' => $request->banner_first_link_text,
                'banner_second_link' => $request->banner_second_link,
                'banner_second_link_text' => $request->banner_second_link_text,
                'banner_sequence' => $request->banner_sequence,
                'banner_status' => $request->status,
                'updated_by' => Auth::id(),
            ]);
        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }


    public function delete($banner_uid)
    {
        $banner = Banner::where('uid', $banner_uid)->firstOrFail();
        if ($banner->banner_file_name) {
            @unlink(public_path() . '/images/banner/' . $banner->banner_file_name);
        }
        $banner = Banner::where('uid', $banner_uid)
            ->forceDelete();
        return response()->json(['message' => 'ลบข้อมูลเรียบร้อยแล้ว', 'data' => $banner], 201);
    }
}
