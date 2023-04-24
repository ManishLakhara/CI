<?php

namespace App\Http\Controllers;

use App\Models\FavoriteMission;
use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\MissionRating;
use App\Models\MissionSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CmsPage;
class MissionDetailController extends Controller
{
    public function main($mission_id){
        $user=Auth::user();
        $mission = Mission::where('mission_id',$mission_id)
                            ->first();
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
        $my_rating = MissionRating::where('mission_id','=',$mission_id)
                                    ->where('user_id','=',$user->user_id)
                                    ->first();
        $rating_a = MissionRating::where('mission_id',$mission_id)
                                ->get()
                                ->pluck('rating');
        $rating=0;
        foreach ($rating_a as $value) {
            $rating += $value;
        }
        $count_rating=count($rating_a);
        if($count_rating==0){
            $avg_rating=0;
        }else{
            $avg_rating=ceil($rating/$count_rating);
        }

        $policies = CmsPage::orderBy('cms_page_id', 'asc')->get();
        return view('mission',compact('mission','users','skills','data','favorite','my_rating','avg_rating','count_rating','policies'));
    }
    public function showVolunteer(Request $request){
        //dd('$request');
        if($request->ajax()){
            $recent_a = MissionApplication::where('approval_status','APPROVE')
                                            ->where('mission_id',$request->mission_id)->get()->pluck('user_id');
            $volunteers = User::whereIn('user_id',$recent_a)->paginate(9);
            return view('components.recentvolunteers',compact('volunteers'))->render();
        }
    }
    public function getRating($mission_id){
        $my_rating = MissionRating::where('mission_id','=',$mission_id)
                                    ->where('user_id','=',auth()->user())
                                    ->first();
        $rating_a = MissionRating::where('mission_id',$mission_id)
                                ->get()
                                ->pluck('rating');
        $rating=0;
        foreach ($rating_a as $value) {
            $rating += $value;
        }
        $count_rating=count($rating_a);
        if($count_rating==0){
            $avg_rating=0;
        }else{
            $avg_rating=ceil($rating/$count_rating);
        }
        return view('components.rating',compact('avg_rating','count_rating'));
    }
}
