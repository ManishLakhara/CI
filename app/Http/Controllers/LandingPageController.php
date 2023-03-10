<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Skill;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $data = Mission::orderBy('mission_id','desc')->paginate(9);
        $countries = Country::all(['country_id','name']);
        $themes = MissionTheme::all(['mission_theme_id','title']);
        $skills = Skill::all(['skill_id','skill_name']);
        //$data = MissionTheme::orderBy('mission_theme_id','desc')->paginate(10);
        return view('index',compact('data','countries','themes','skills')); // Create view by name missiontheme/index.blade.php
    }
}
