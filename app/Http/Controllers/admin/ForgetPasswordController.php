<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminResetPassword;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function forgetpassword(Request $request)
    {
        return view('admin.auth.forgetpassword');
    }

    public function reset(Request $request)
    {

        return view('admin.auth.login');
    }

    public function resetpassword(Request $request)
    {

        return view('admin.auth.resetpassword');
    }

    protected $email;
    public function admincheckEmail(Request $request)
    {

        if ($request->email == null) {
            return back()->with('message', 'please Enter Email Address');
        } else {
            if (admin::where('email', $request->email)->get()->isEmpty()) {
                return back()->with('message', 'please Enter Valid Email');
            } else {
                //$this->email = $request->email;
                // return redirect()->intended('resetpassword');

                $token = Str::random(60);

                $user['token'] = $token;

                $user->save();

                Mail::to($request->email)->send(new AdminResetPassword($user->name, $token));

                if(Mail::failures() != 0) {
                    return back()->with('success', 'Success! password reset link has been sent to your email');
                }
                return back()->with('failed', 'Failed! there is some issue with email provider');

            }
        }
    }
}
