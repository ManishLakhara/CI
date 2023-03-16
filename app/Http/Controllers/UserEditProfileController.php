<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Http\Requests\UserProfileUpdateRequest;

class UserEditProfileController extends Controller
{
    public function index()
    {

        return view('usereditprofile');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('usereditprofile', compact('user'));
    }
}
