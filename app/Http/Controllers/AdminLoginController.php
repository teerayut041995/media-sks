<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AdminLoginRequest;
use Auth;
class AdminLoginController extends Controller
{
    public function index()
    {
    	return view('admin.login');
    }
    public function checkLogin(AdminLoginRequest $request)
    {
    	
	    $email  = $request->input('email');
	    $password = $request->input('password');

	    if(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 'admin']))
     	{
      		return redirect()->intended('administrator');
     	}
     	else
     	{
      		return back()->with('error', 'อีเมล์ หรือรหัสผ่านของคุณไม่ถูกต้อง');
     	}
    }
    public function logout()
    {
	    Auth::logout();
	    return redirect()->intended('administrator/login');
    }
}
