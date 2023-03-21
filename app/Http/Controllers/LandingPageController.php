<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Skill;
use App\Models\FavoriteMission;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{

    public function index(Request $request)
    {
        $count = 0;
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

        // $data = $data->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
        //              ->join('skills','mission_skills.skill_id','=','skills.skill_id');
                    //  ->get(['missions.*','skills.skill_name']);

        if(isset($request->country_f))
        {
            $country_id_array = explode(',',$request->country_f);

            $data = $data->whereIn('country_id',$country_id_array);
        }
        if(isset($request->city_f)){

            $city_id_array = explode(',',$request->city_f);

            $data = $data->whereIn('city_id',$city_id_array);
        }
        if(isset($request->theme_f)){

            $theme_id_array = explode(',',$request->theme_f);
            $data = $data->whereIn('theme_id',$theme_id_array);
        }
        if(isset($request->skill_f)){

            $skill_id_array = explode(',',$request->skill_f);
            // $data = $data->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
            //              ->whereIn('mission_skills.skill_id',$skill_id_array);
            $data = $data->select('missions.*')
                         ->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
                         ->whereIn('mission_skills.skill_id',$skill_id_array);
        }

        // Here adding extra functions to missions
        //  $data = $data->Join('goal_missions',function($query){
        //     $query->on('goal_missions.mission_id','=','missions.mission_id');
        //     $query->where('missions.mission_type','=','GOAL');
        //  });

         //dd($data->get()->toArray());
        if(isset($request->sort)){
            switch($request->sort){
                case '1':
                    $data = $data->orderBy('start_date','desc');
                    break;
                case '2':
                    $data = $data->orderBy('start_date','asc');
                    break;
                case '3':

                    $data = $data->select('missions.*')
                                 ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('time_missions.total_seats', 'asc');
                    break;
                case '4':
                    $data = $data->select('missions.*')
                                 ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('time_missions.total_seats', 'desc');
                    break;
                case '5':
                    $data = $data->select('missions.*')
                                 ->leftJoin('favorite_missions','favorite_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('favorite_missions.created_at', 'desc');
                    break;
                case '6':
                    $data = $data->select('missions.*')
                                 ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                 ->orderBy('time_missions.registration_deadline', 'desc');
                    break;
            }
        }
        $count = $data->count();
        $data = $data->paginate(9)->appends(["s" => $request->s,
                                             "country_f" => $request->country_f,
                                             "city_f"=>$request->city_f,
                                             "theme_f" => $request->theme_f,
                                             "skill_f" => $request->skill_f,
                                             "sort" => $request->sort,
                                            ]);

        $countries = Country::all(['country_id','name']);
        $themes = MissionTheme::all(['mission_theme_id','title']);
        $skills = Skill::all(['skill_id','skill_name']);
        $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);
        $users = User::where('user_id','!=',Auth::user()->user_id)
                       ->orderBy('user_id','asc')
                       ->get();
        return view('index', compact('data','count','countries','themes','skills','favorite','users')); // Create view by name missiontheme/index.blade.php
    }
}
