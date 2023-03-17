<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Requests\UserProfileUpdateRequest;
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

        return view('usereditprofile', compact('user','countries','cities'));
    }





    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->country_id = $request->input('country');
        $user->city_id = $request->input('city');
        $user->save();

        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully!');
    }


    public function updatePassword(Request $request)
    {
        // Validate the input data
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect the user with a success message
        return redirect()->back()->with('success', 'Your password has been updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('login');
    }

}
