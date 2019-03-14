<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('adminAuth');
    }
    public function index ()
    {
    	// if (Auth::check() == false) {
     //        echo "Login";
     //    } else {
        	
     //    }
    	return view('admin.index');
    }
}
