<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionDetailController extends Controller
{
    public function main($mission_id){
        $mission = Mission::where('mission_id',$mission_id)
                            ->get()[0];
        return view('mission',compact('mission'));
    }
}
