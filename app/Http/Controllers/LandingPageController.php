<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Skill;
use App\Models\FavoriteMission;
use App\Models\MissionSkill;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{

    public function index()
    {
        //$count = 0;
        $data = Mission::where('mission_id','!=',null);
        $count = $data->count();
        $countrys = $data->pluck('country_id')->toArray();
        $country_ids = array_unique($countrys);
        $countries = Country::whereIn('country_id',$country_ids)
                            ->get(['country_id','name']);
        $themes = $data->pluck('theme_id')->toArray();
        $theme_ids = array_unique($themes);
        $themes = MissionTheme::whereIn('mission_theme_id',$theme_ids)
                                ->get(['mission_theme_id','title']);
        $skills = MissionSkill::all(['skill_id'])->pluck('skill_id')->toArray();
        $skill_ids = array_unique($skills);
        $skills = Skill::whereIn('skill_id',$skill_ids)->get(['skill_id','skill_name']);

        $citys = $data->pluck('city_id')->toArray();
        $city_ids = array_unique($citys);
        $cities = City::whereIn('city_id',$city_ids)->get(['city_id','name']);

        $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);

        $users = User::where('user_id','!=',Auth::user()->user_id)
                       ->orderBy('user_id','asc')
                       ->get();
        $data = $data->orderBy('created_at','desc')->paginate(9);
        return view('index', compact('data','count','countries','cities','themes','skills','favorite','users')); // Create view by name missiontheme/index.blade.php
    }

    public function filterApply(Request $request){
        if($request->ajax()){
            $user_id = Auth::user()->user_id;
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
            if(isset($request->countries)){
                $country_id_array = explode(',',$request->countries);
                $datas = $datas->whereIn('country_id',$country_id_array);
            }
            if(isset($request->cities)){
                $city_id_array = explode(',',$request->cities);
                $datas = $datas->whereIn('city_id',$city_id_array);
            }
            if(isset($request->themes)){
                $theme_id_array = explode(',',$request->themes);
                $datas = $datas->whereIn('theme_id',$theme_id_array);
            }
            if(isset($request->skills)){
                $skill_id_array = explode(',',$request->skills);
                $datas = $datas->select('missions.*')
                               ->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
                               ->whereIn('mission_skills.skill_id',$skill_id_array)
                               ->distinct();
            }
            if(isset($request->sort)){
                switch($request->sort){
                    case '1':
                        $datas = $datas->orderBy('start_date','desc');
                        break;
                    case '2':
                        $datas = $datas->orderBy('start_date','asc');
                        break;
                    case '3':

                        $datas = $datas->select('missions.*')
                                     ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                     ->orderBy('time_missions.created_at','desc')
                                     ->orderBy('time_missions.total_seats', 'asc');


                        break;
                    case '4':
                        $datas = $datas->select('missions.*')
                                     ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                     ->orderBy('time_missions.total_seats', 'desc');
                        break;
                    case '5':
                        $datas = $datas->select('missions.*')
                                     ->leftJoin('favorite_missions','favorite_missions.mission_id','=','missions.mission_id')
                                     ->orderBy('favorite_missions.created_at', 'desc');
                        break;
                    case '6':
                        $datas = $datas->select('missions.*')
                                     ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                                     ->orderBy('time_missions.registration_deadline', 'desc');
                        break;
                }
            }
            $count = $datas->count();
            $data = $datas->paginate(9);
            $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);

            $users = User::where('user_id','!=',Auth::user()->user_id)
                        ->orderBy('user_id','asc')
                        ->get();
            return view('components.gridListView', compact('count','data','favorite','users','user_id'));
        }
    }

    public function findCity(Request $request){
        if($request->ajax()){
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
            $datas = $datas->whereIn('country_id',$request->countries);
            $citys = $datas->pluck('city_id')->toArray();
            $city_ids = array_unique($citys);
            $cities = City::whereIn('city_id',$city_ids)->get(['city_id','name']);
            return view('components.city-dropper', compact('cities'));
        }
    }

    public function findTheme(Request $request){
        if($request->ajax()){
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
            $datas = $datas->whereIn('country_id',$request->countries);
            $datas = $datas->whereIn('city_id', $request->cities);
            $theme_ids = $datas->pluck('theme_id')->toArray();
            $theme_ids = array_unique($theme_ids);
            $themes = MissionTheme::whereIn('mission_theme_id',$theme_ids)->get(['mission_theme_id','title']);
            return view('components.theme-dropper', compact('themes'));
        }
    }

    public function findSkill(Request $request){
        if($request->ajax()){
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
            $datas = $datas->whereIn('country_id',$request->countries);
            $datas = $datas->whereIn('city_id', $request->cities);
            $datas = $datas->whereIn('theme_id', $request->themes)
                    ->with('skill');
            $skill_ids = [];
            $mission_ids = $datas->pluck('mission_id');
            $skill_ids = MissionSkill::whereIn('mission_id',$mission_ids)->pluck('skill_id')->toArray();
            $skill_ids = array_unique($skill_ids);
            $skills = Skill::whereIn('skill_id',$skill_ids)->get(['skill_name','skill_id']);
            return view('components.skill-dropper', compact('skills'));
        }
    }
}
{{}}
