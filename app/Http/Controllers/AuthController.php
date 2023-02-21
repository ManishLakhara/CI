<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\User;

class AuthController  {

    protected $resetEmail;


    public function login(){
        return view('login');
    }

    public function index(){
        return view('index');
    }

    public function customLogin(Request $request): RedirectResponse {
        


        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email','=', $credentials['email'])->get();

        if($user->isEmpty()){

        }
        if($user->password == $credentials['password']){
            return redirect()->intended('index')->withSuccess('Succesfully logined');
        }
        // if(Auth::attempt($credentials)){
        //     return redirect()->intended('index')->withSuccess('Succesfully logined');
        // }

        // return redirect()->intended('login')->withSuccess('Invalid credentials');

        // if($user=User::where($credentials)->first()) {
        //     auth()->login($user);
        //     return redirect()->intended('index')->withSuccess('Successfully Logined');
        // }

        // else{
        //     return redirect()->intended('login')->withError('Incorrect Credentials');
        // }

        return redirect()->intended('/')->with('status','Incorrect Credentials');

    }

    public function reset(Request $request) {
        $this->resetEmail = $request->email;
    }

}
