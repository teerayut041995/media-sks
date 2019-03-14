<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\EventImage;
use Carbon\Carbon;
use DB;
class EnentController extends Controller
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
        $events = Event::orderBy('created_at' , 'DESC')->get();
        return view('admin.event.index' , compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {   
        if ($request->file('event_image') != '') {
            $file_image = $request->file('event_image');
            $event_image = md5(rand()*time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/image_event'), $event_image);
        } else {
            $event_image = "";
        }
        $date = str_replace("-", "", $request->input('event_date'));
        $event_date = Carbon::parse($date)->format('Y-m-d');
        $event = new Event([
            "event_name" => $request->input('event_name'),
            "event_image" => $event_image,
            "event_date" => $event_date,
            "event_location" => $request->input('event_location'),
            "event_description" => $request->input('event_description'),
            "publishing_status" => $request->input('publishing_status'),
            "user_id" => Auth::user()->id
        ]);
        $event->save();
        return redirect("administrator/event/$event->id")->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::leftJoin('users' , 'events.user_id' , 'users.id')
                ->select('events.*','users.name')
                ->where('events.id' , $id)->first();
        $images = EventImage::where('event_id' , $event->id)->get();  
        return view('admin.event.show' , compact('event','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.event.edit' , compact('event','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);
        if ($request->file('event_image') != '') {
            $event_image = $request->file('event_image');
            $image_name = md5(rand()*time()) . '.' . $event_image->getClientOriginalExtension();
            $event_image->move(public_path('images/image_event'), $image_name);
            if ($request->get('old_post_image') != '') {
                @unlink(public_path().'/images/image_event/'.$event->event_image);
            }
        } else {
            $image_name = $event->event_image;
        }
        $date = str_replace("-", "", $request->input('event_date'));
        $event_date = Carbon::parse($date)->format('Y-m-d');

        $event->event_name= $request->input('event_name');
        $event->event_image= $image_name;
        $event->event_date= $event_date;
        $event->event_location = $request->input('event_location');
        $event->event_description= $request->input('event_description');
        $event->save();
        return redirect('administrator/event')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = EventImage::where('event_id' , $id)->get();
        foreach ($images as $image) {
            if ($image->image_name != '') {
                @unlink(public_path().'/images/image_event/more_image/'.$image->image_name);
            }
        }
        $event = Event::find($id);
        $event->delete();
        return redirect("administrator/event")->with('success','ลบข้อมูลเรียบร้อยแล้ว');
    }
    public function active($id)
    {
        $event = Event::find($id);
        $event->publishing_status = '1';
        $event->save();
        return redirect('administrator/event')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function unactive($id)
    {
        $event = Event::find($id);
        $event->publishing_status = '0';
        $event->save();
        return redirect('administrator/event')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function delete_image($id)
    {
        $image = EventImage::find($id);
        $image_name = $image->image_name;
        if ($image_name != '') {
            @unlink(public_path().'/images/image_event/more_image/'.$image_name);
        }
        $image->delete(); 
        return redirect("administrator/event/$image->event_id")->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function upload_image(Request $request , $id)
    {
        if ($request->file('image_name') != '') {
            $file_image = $request->file('image_name');
            $image_name = md5(rand()*time()) . '.' . $file_image->getClientOriginalExtension();
            $file_image->move(public_path('images/image_event/more_image'), $image_name);
        } else {
            $image_name = "";
        }
        $image = new EventImage([
            "image_name" =>$image_name,
            "event_id" =>$id
        ]);
        $image->save();
       return redirect("administrator/event/$id")->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
