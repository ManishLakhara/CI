<?php

namespace App\Http\Controllers;

use App\Models\MissionApplication;
use App\Models\User;
use Illuminate\Http\Request;

class MissionApplicationController extends Controller
{
    public function newMissionApplication(Request $request){
        $req = MissionApplication::where('mission_id',$request->mission_id)
                                    ->where('user_id',$request->user_id);
        MissionApplication::create($request->post());
        return "Mission Application Request submitted";
    }
}
