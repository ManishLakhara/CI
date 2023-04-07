<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoryInvite;

class StoryInviteController extends Controller
{
    public function inviteUser(Request $repuest)
    {
        $invite = StoryInvite::create($repuest->post());
        return;
    }
}
