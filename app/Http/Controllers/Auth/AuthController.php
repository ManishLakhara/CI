<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use \Illuminate\Support\Facades\Session;

class AuthController extends Controller {
    /* This is controller for Authentication of user 
     * i.e volunteer  
    */
    public function index()
    {
        return view('login.login');
    }

    public function logout(){
        Session::flush();
        return redirect('/');
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
            return redirect()->intended('/')->with('status','Oppes! Credentials Passed are INCORRECT');
        }
    }

    public function register(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(User::where('email',$request->email)->count()===0){
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => bcrypt($request->password), 
            ]);
            return redirect()->intended('/')->with('success', $user->first_name.' New User is Registered');
        }
        else{
            return redirect()->intended('register')->with('status','user-Already exists');
        }
    }
}