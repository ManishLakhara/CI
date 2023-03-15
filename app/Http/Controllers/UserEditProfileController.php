<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Requests\UserProfileUpdateRequest;

class UserEditProfileController extends Controller
{
    public function index(){
        return view('usereditprofile');
    }

    public function update(User $user, UserProfileUpdateRequest $request)
    {
        $countries = Country::get(['name', 'country_id']);
        $cities = City::where("country_id", $user->country_id)->get();
        $user->fill($request->post())->save();

        return $this->success('profile','Profile updated successfully!');
    }
}
