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
        $count = 0;
        $data = Mission::where([
            //['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)){
                    $query->orWhere('title','LIKE','%'.$s.'%')
                          ->orWhere('mission_type', 'LIKE', '%'.$s.'%')
                          ->get();
                }
            }]
        ]);
        
        if(isset($request->country_f))
        {
            $data = $data->where('country_id',$request->country_f);
        }   
        // if(isset($request->city_f)){
        //     $data = $data->where('city_id',$request->country_f);
        // }
        if(isset($request->theme_f)){
            $data = $data->where('theme_id',$request->theme_f);
        }
        if(isset($request->skill_f)){
            $data = $data->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
                         ->where('mission_skills.skill_id',$request->skill_f);
        }
        
        $count = $data->count();
        $data = $data->paginate(9)->appends(["s" => $request->s,"country_f" => $request->country_f,"city_f"=>$request->city_f,"theme_f" => $request->theme_f,"skill_f" => $request->skill_f]);
        $countries = Country::all(['country_id','name']);
        $themes = MissionTheme::all(['mission_theme_id','title']);
        $skills = Skill::all(['skill_id','skill_name']);
        return view('index',compact('data','count','countries','themes','skills')); // Create view by name missiontheme/index.blade.php
    }
    
    // public function filterData(Request $request){
    //     $data = Mission::orderBy('mission_id','desc')->with('country');
    //     $count = $data->count();
    //     return ([$count,]);
    // }
}
