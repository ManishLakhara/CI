<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\controller;
use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{

    public function resetPassword(Request $request){
        if($request->email==null){
            return back()->with('status','please Enter Email Address');
        }
        else{
            $link='<a style="text-decoration:none;" href="{{route(\'register\')}}">Create an account</a>';
            if(User::where('email',$request->email)->get()->isEmpty()){
                return back()->with('status',' This '.$request->email.' is not Registered. Please register here '.$link);
            }else{

                $this->validate($request, [
                    'email' => 'required|email',
                ]);
                $user = new PasswordReset;
                $token = Str::random(60);
                $user['email'] = $request->email;
                $user['token'] = $token;
                $user->save();

                Mail::to($request->email)->send(new ResetPassword($user['email'],$token));
        
                if(Mail::failures() != 0) {
                    return back()->with('success', 'Success! password reset link has been sent to your email');
                }
                return back()->with('failed', 'Failed! there is some issue with email provider');


            }

        }





        
    }
}
