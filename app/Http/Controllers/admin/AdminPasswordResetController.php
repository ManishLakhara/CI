<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\PasswordReset;
use App\Mail\AdminResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminPasswordResetController extends Controller
{
    public function resetPassword(Request $request){
        if($request->email==null){
            return back()->with('status','please Enter Email Address');
        }
        else{
            $link='<a style="text-decoration:none;" href="{{route(\'register\')}}">Create an account</a>';
            if(Admin::where('email',$request->email)->get()->isEmpty()){
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

                $mail = Mail::to($request->email)->send(new AdminResetPassword($user['email'],$token));

                if($mail) {
                    return back()->with('success', 'Success! password reset link has been sent to your email');
                }
                return back()->with('failed', 'Failed! there is some issue with email provider');


            }

        }

    }

    public function adminPasswordResetting(Request $request){
        $request->validate(

            ['token' => 'required',
             'password' => 'required | min:8',
             'confirm-password' => 'required | min:8',
             ]

        );

        if($request['password']!==$request['confirm-password']){
           
            return back()->with('error',"confirm password is different from password");

        }

        $reset = PasswordReset::where('token',$request['token'])->get();
        $email = $reset[0]->email;

        $user = Admin::where('email',$email)->get()[0];
        $user->password = bcrypt($request['password']);
        $user->save();

        return redirect()->intended('/')->with('success','Hurry!! Password have been Successfully updated');
    }

}
