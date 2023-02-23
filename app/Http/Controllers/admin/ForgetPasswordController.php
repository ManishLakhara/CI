<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
class ForgetPasswordController extends Controller
{
   public function forgetpassword(Request $request){
            return view('admin.auth.forgetpassword');
   }

   public function reset(Request $request){

    return view('admin.auth.login');
}

public function resetpassword(Request $request){

    return view('admin.auth.resetpassword');
}

  protected $email;
public function admincheckEmail(Request $request) {

    if($request->email==null){
        return back()->with('message','please Enter Email Address');
    }
    else{
        if(admin::where('email',$request->email)->get()->isEmpty()){
            return back()->with('message','please Enter Valid Email');
        }else{
            $this->email = $request->email;
            return redirect()->intended('resetpassword');
        }

    }
}


}
