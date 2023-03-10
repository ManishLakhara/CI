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
        // $data = Mission::orderBy('mission_id','desc')->paginate(9);
        $datas = Mission::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)){
                    $query->orWhere('title','LIKE','%'.$s.'%')
                          ->orWhere('mission_type', 'LIKE', '%'.$s.'%')
                          ->get();
                }
            }]
        ]);
        $count = $datas->count();
        $data = $datas->paginate(9)->appends(['s'=>$request->s]);
        $countries = Country::all(['country_id','name']);
        $themes = MissionTheme::all(['mission_theme_id','title']);
        $skills = Skill::all(['skill_id','skill_name']);
        return view('index',compact('data','countries','themes','skills','count')); // Create view by name missiontheme/index.blade.php
    }
}
