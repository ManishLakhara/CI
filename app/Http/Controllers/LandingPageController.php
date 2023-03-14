<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    
    public function index(Request $request)
    {
        // $datas = Mission::orderBy('mission_id','desc');
        $data = Mission::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)){
                    $query->orWhere('title','LIKE','%'.$s.'%')
                          ->orWhere('mission_type', 'LIKE', '%'.$s.'%')
                          ->get();
                }
            }]
        ]);
        
        // if(isset($request->countries_array))
        // {
        //     $data = $data->whereIn('country_id',$request->countries_array);
        //     return $data;
        // }
        
        $count = $data->count();
        $data = $data->paginate(9);
        $countries = Country::all(['country_id','name']);
        $themes = MissionTheme::all(['mission_theme_id','title']);
        $skills = Skill::all(['skill_id','skill_name']);
        return view('index',compact('data','count','countries','themes','skills')); // Create view by name missiontheme/index.blade.php
    }
    
    public function filterData(Request $request){
        $data = Mission::orderBy('mission_id','desc')->with('country');
        $count = $data->count();
        $data = $data->paginate(9);
        return ([$count,]);
    }
}
