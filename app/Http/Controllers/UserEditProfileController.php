<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class UserEditProfileController extends Controller
{

    public function editProfile(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if (!$user || $user->user_id != auth()->user()->user_id) {
            return redirect()->route('login');
        }



        $countries = Country::get(['name', 'country_id']);
        $cities = City::where("country_id", $user->country_id)->get();

        return view('usereditprofile', compact('user', 'countries', 'cities'));
    }





    public function updateProfile(UpdateUserProfileRequest $request)
    {
        $user = Auth::user();
        // dd($user);
        $user_id = $user->user_id;
        //dd($request);
        $u1 = User::find($user_id);
        $u1->fill($request->post());
        $u1->save();
        return redirect()->route('landing.index')->with('success', 'Profile updated successfully!');
        // dd($request);
    }


    public function updatePassword(Request $request)
    {

        // Validate the input data
        // $request->validate([
        //     'old_password' => 'required',
        //     'password' => 'required|min:8',
        //     'confirm_password' => 'required|same:password',
        // ]);

        // // Get the authenticated user

        $user_id = $request->user_id;
        $u1 = User::find($user_id);
        // // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, $u1->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // // Update the user's password

        $u1->password = bcrypt($request->password);
        $u1->save();

        // // Redirect the user with a success message
        // return redirect()->back()->with('success', 'Your password has been updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('login');
    }
}
