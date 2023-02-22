<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
        $credentionals = $request->only('email','password');
        if(Auth::guard('admin')->attempt($credentionals)){
            return view('admin.index');
        } else {
            return redirect()->intended('adminlogin')->with('status','Oppes! You have entered wrong password');
        }
    }




}








