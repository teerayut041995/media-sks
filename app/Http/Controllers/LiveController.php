<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use Carbon\Carbon;
class LiveController extends Controller
{
    public function index()
    {
    	$check = Media::where('publishing_status' , '1')
    		->where('live_status' , '1')
    		->orderBy('created_at' , 'DESC')
    		->first();
    	if ($check) {
    		$first_media = Media::where('publishing_status' , '1')
    		->where('live_status' , '1')
    		->orderBy('created_at' , 'DESC')
    		->first();
    	} else {
    		$first_media = Media::where('publishing_status' , '1')
	    		->where('live_status' , '2')
	    		->orderBy('created_at' , 'DESC')
	    		->first();
    	}
        $expiresAt = now()->addHours(3);
        views($first_media)
            ->delayInSession($expiresAt)
            ->record();
        $first_views = views($first_media)->count();

        $media_list = Media::leftJoin('users' , 'media.user_id' , 'users.id')
                        ->select('media.*','users.name')
                        ->where('publishing_status' , '1')
                        ->where('live_status' , '!=' ,  '0')
                        ->orderBy('created_at' , 'DESC')
                        ->get();
        return view('frontend.live' , compact('first_media','first_views','media_list'));
    }
    public function watch($id)
    {
    	$media = Media::leftJoin('users' , 'media.user_id' , 'users.id')
                        ->select('media.*','users.name')
                        ->where('publishing_status' , '1')
                        ->where('live_status' , '!=' ,  '0')
                        ->where('media.id' , $id)
                        ->first();
        $expiresAt = now()->addHours(3);
        views($media)
            ->delayInSession($expiresAt)
            ->record();
        $views = views($media)->count();
        return view('frontend.watch' , compact('media','views'));
    }
}
