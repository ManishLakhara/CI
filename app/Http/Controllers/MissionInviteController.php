<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MissionInvite;

class MissionInviteController extends Controller
{
    public function inviteUser(Request $repuest){
        $invite = MissionInvite::create($repuest->post());
        return;
    }
}
