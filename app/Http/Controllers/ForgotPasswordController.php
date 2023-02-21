<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
class ForgotPasswordController extends Controller
{
    protected $email;

    public function checkEmail(Request $request) {
        
        if($request->email==null){
            return back()->with('message','please Enter Email Address');
        }
        else{
            if(User::where('email',$request->email)->get()->isEmpty()){
                return back()->with('message','please Enter Valid Email');
            }else{
                $this->email = $request->email;
                return redirect()->intended('reset');
            }

        }
    }

    public function resetPassword(Request $request){
        $newpassword = $request->password;
        $user = User::where('email',$this->email)->get();
        dd($user);
    }
}
