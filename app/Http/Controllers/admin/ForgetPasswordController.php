<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminResetPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ForgetPasswordController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function forgetpassword(Request $request): View
    {
        return view('admin.auth.forgetpassword');
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function reset(Request $request): View
    {

        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function resetpassword(Request $request): View
    {
        return view('admin.auth.resetpassword');
    }

    protected $email;
    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function admincheckEmail(Request $request): RedirectResponse
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
