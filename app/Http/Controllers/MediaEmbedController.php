<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Media;
class MediaEmbedController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media_all = Media::leftJoin('users', 'media.user_id', '=', 'users.id')
            ->select('media.*', 'users.name')
            ->orderBy('created_at' , 'DESC')
            ->get();
        return view('admin.media.index' , compact('media_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        if ($request->input('description') != '') {
            $description = $request->input('description');
        } else {
            $description = '';
        }
        $media = new Media([
            "project_name" => $request->input('project_name'),
            "topics" => $request->input('topics'),
            "lecturer" => $request->input('lecturer'),
            "description" => $description,
            "embed_video" => $request->input('embed_video'),
            "live_status" => $request->input('live_status'),
            "publishing_status" => $request->input('publishing_status'),
            "user_id" => Auth::user()->id
        ]);
        $media->save();
        return redirect('administrator/media-embed')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = Media::leftJoin('users', 'media.user_id', '=', 'users.id')
            ->select('media.*', 'users.name')
            ->where('media.id' , $id)
            ->first();
        $media->addViewWithExpiryDate(Carbon::now()->addHours(2));
        $views = $media->getUniqueViews();
        return view('admin.media.show' , compact('media' , 'views'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::find($id);
        return view('admin.media.edit' , compact('media' , 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, $id)
    {
        $media = Media::find($id);
        if ($request->input('description') != '') {
            $description = $request->input('description');
        } else {
            $description = '';
        }
        $media->project_name = $request->input('project_name');
        $media->topics = $request->input('topics');
        $media->lecturer = $request->input('lecturer');
        $media->description = $description;
        $media->embed_video = $request->input('embed_video');
        $media->save();
        return redirect('administrator/media-embed')->with('success','แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);
        $media->delete();
        return redirect('administrator/media-embed')->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }

    public function active($id)
    {
        $media = Media::find($id);
        $media->publishing_status = '1';
        $media->save();
        return redirect('administrator/media-embed')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function unactive($id)
    {
        $media = Media::find($id);
        $media->publishing_status = '0';
        $media->save();
        return redirect('administrator/media-embed')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function start($id)
    {
        $media = Media::find($id);
        $media->live_status = '1';
        $media->save();
        return redirect('administrator/media-embed')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        
    }
    public function stop($id)
    {
        $media = Media::find($id);
        $media->live_status = '2';
        $media->save();
        return redirect('administrator/media-embed')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
