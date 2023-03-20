<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Skill;
use App\Models\FavoriteMission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{

    public function index(Request $request)
    {
        // $datas = Mission::orderBy('mission_id','desc');
        // $user = Auth::user();
        $count = 0;
        $data = Mission::where([
            // ['title', '!=', Null],
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
        if(isset($request->city_f)){
            $data = $data->where('city_id',$request->city_f);
        }
        if(isset($request->theme_f)){
            $data = $data->where('theme_id',$request->theme_f);
        }
        if(isset($request->skill_f)){
            $data = $data->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
                         ->where('mission_skills.skill_id',$request->skill_f);
        }
        // $favorite = FavoriteMission::where('user_id',$user_id)
        //                              ->get(['favorite_mission_id','mission_id']);

        // Sorting Areas
        if(isset($request->sort)){
            switch($request->sort){
                case '1':
                    $data = $data->orderBy('start_date','desc');
                    break;
                case '2':
                    $data = $data->orderBy('start_date','asc');
                    break;
                case '5':
                    // $data = $data->get()->sortBy('favoriteMission.created_at');
                    // break;
            }
        }


        $count = $data->count();
        $data = $data->paginate(9)->appends(["s" => $request->s,"country_f" => $request->country_f,"city_f"=>$request->city_f,"theme_f" => $request->theme_f,"skill_f" => $request->skill_f]);
        $countries = Country::all(['country_id','name']);
        $themes = MissionTheme::all(['mission_theme_id','title']);
        $skills = Skill::all(['skill_id','skill_name']);
        $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);
        $users = User::where('user_id','!=',Auth::user()->user_id)
                       ->orderBy('user_id','asc')
                       ->get();
        return view('index',compact('data','count','countries','themes','skills','favorite','users')); // Create view by name missiontheme/index.blade.php
    }

    // public function filterData(Request $request){
    //     $data = Mission::orderBy('mission_id','desc')->with('country');
    //     $count = $data->count();
    //     return ([$count,]);
    // }
}
