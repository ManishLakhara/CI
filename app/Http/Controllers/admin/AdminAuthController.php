<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(Request $request){

        return view('admin.auth.login');
    }

    public function index(Request $request){
        return view('admin.index');
    }
    public function dashboard(Request $request){
        return view('admin.index');
    }
     public function customLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
            'captcha' => 'required|captcha'
        ]);
        $credentionals = $request->only('email','password');
        if(Auth::guard('admin')->attempt($credentionals)){
            $intendedUrl = session()->get('url.intended', 'user');
            return redirect()->intended($intendedUrl);
            // return redirect()->route('user.index')->with('success',' You have login');
        } else {
            return redirect()->intended('adminlogin')->with('status','Oppes! You have entered wrong password');
        }
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();

        return redirect()->route('adminlogin');
    }



}







