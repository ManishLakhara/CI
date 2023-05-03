<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoryInvite;

class StoryInviteController extends Controller
{
    /**
     * @param Request $repuest
     *
     * @return void
     */
    public function inviteUser(Request $repuest): void
    {
        $invite = StoryInvite::create($repuest->post());
    }
}
