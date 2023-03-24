<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MissionDetailController extends Controller
{
    public function main($mission_id){
        $user=Auth::user();
        $mission = Mission::where('mission_id',$mission_id)
                            ->get()[0];
        return view('mission',compact('mission','user'));
    }
}
