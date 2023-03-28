<?php

namespace App\Http\Controllers;

use App\Models\FavoriteMission;
use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\MissionSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MissionDetailController extends Controller
{
    public function main($mission_id){
        $user=Auth::user();
        $mission = Mission::where('mission_id',$mission_id)
                            ->get()[0];
        $users = User::where('user_id','!=',Auth::user()->user_id)
        ->orderBy('user_id','asc')
        ->get();
        $skill_id_array = MissionSkill::where('mission_id',$mission_id)->get()->pluck('skill_id');
        $skills = Skill::whereIn('skill_id',$skill_id_array)->get()->pluck('skill_name');
        $favorite = FavoriteMission::where('user_id',Auth::user()->user_id)
                                     ->get(['favorite_mission_id','mission_id']);
        $data = Mission::where('theme_id',$mission->theme_id)
                        ->where('mission_id','!=',$mission->mission_id)
                        ->limit(3)
                        ->get();
        //
        $recent_a = MissionApplication::where('mission_id',$mission_id)->get()->pluck('user_id');
        $volunteers = User::whereIn('user_id',$recent_a)
        ->paginate(9);
        return view('mission',compact('mission','users','skills','data','favorite','volunteers'));
    }
}
