<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MissionInvite;

class MissionInviteController extends Controller
{
    /**
     * @param Request $repuest
     *
     * @return void
     */
    public function inviteUser(Request $repuest): void{
        $invite = MissionInvite::create($repuest->post());
    }
}
