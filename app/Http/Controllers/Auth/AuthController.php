<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\User;


class AuthController extends Controller {
    /* This is controller for Authentication of user 
     * i.e volunteer  
    */
    public function index()
    {
        return view('login.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentionals = $request->only('email','password');
        if(Auth::attempt($credentionals)){
            return redirect()->intended('index');
        } else {
            return redirect()->intended('/')->with('status','Oppes! You have entered wrong password');
        }
    }
}