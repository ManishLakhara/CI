<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\controller;
use App\Http\Requests\ForgotRequest;
use App\Mail\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{

    public function resetPassword(ForgotRequest $request)
    {
            $rules = [
                'email' => 'bail|email|required|exists:users,email|unique:password_resets,email',
            ];
            $customMessages = [
                'unique' => "Reset password Link have already been send",
                'exists' => "This :attribute have not been registered yet!",
            ];
            $this->validate($request, $rules, $customMessages);
            $link='<a style="text-decoration:none;" href="{{route(\'register\')}}">Create an account</a>';
            if(User::where('email',$request->email)->get()->isEmpty()){
                return back()->with('status',' This '.$request->email.' is not Registered. Please register here '.$link);
            }else{
                $this->validate($request, [
                    'email' => 'required|email',
                ]);
                $token = Str::random(60);
                $user = new PasswordReset;
                $user['email'] = $request->email;
                $user['token'] = $token;
                $user->save();
                $mail = Mail::to($request->email)->send(new ResetPassword($user['email'],$token));

                if($mail) {
                    return back()->with('success', 'Success! password reset link has been sent to your email : '.$user['email']);
                }
                return back()->with('failed', 'Failed! there is some issue with email provider');
            }
        }

    public function passwordResetting(Request $request){
        $request->validate(
            ['token' => 'required',
             'password' => 'required | min:8',
             'confirm-password' => 'required | min:8 | same:password',
             ]
        );

        $reset = PasswordReset::where('token',$request['token'])->first();
        $email = $reset->email;

        $user = User::where('email',$email)->first();
        $user->password = bcrypt($request['password']);
        $user->save();
        $reset->delete();
        return redirect()->intended('login')->with('success','Hurry!! Password have been Successfully updated');
    }
}
