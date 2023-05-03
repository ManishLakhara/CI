<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Support\Facades\Request as FacadesRequest;
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
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);
        $credentionals = $request->only('email','password');
        if(Auth::attempt($credentionals)){
            return redirect()->intended('index');
        } else {
            return redirect()->intended('/login')->with('status','Oppes! Incorrect Credentials')
                                                ->withInput(FacadesRequest::except('password'));
        }
    }

    public function register(RegisterRequest $request){

        if(User::where('email',$request->email)->count()===0){

            $user = User::create([
                'avatar' => 'Images/user-img1.png',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return redirect()->intended('/')->with('success', $user->first_name.' New User is Registered');
        }
        else{
            return redirect()->intended('register')->with('status', 'user-Already exists')
                                                    ->with(FacadesRequest::except('password'));
        }
    }
    public function forgot(){
        return view('login.forgot');
    }
}
