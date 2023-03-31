<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Story;
use App\Models\StoryMedia;
use App\Models\MissionApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShareYourStoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();



        $appliedMissionIds = MissionApplication::where('user_id', $user->user_id)
            ->where('approval_status', 'APPROVE')
            ->pluck('mission_id')
            ->toArray();

        $appliedMissions = Mission::whereIn('mission_id', $appliedMissionIds)->get();







        return view('shareyourstory', compact('user',  'appliedMissionIds', 'appliedMissions'));
    }
}
