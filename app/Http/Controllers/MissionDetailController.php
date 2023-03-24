<?php

namespace App\Http\Controllers;

use App\Models\Mission;
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
        return view('mission',compact('mission','users'));
    }
}
