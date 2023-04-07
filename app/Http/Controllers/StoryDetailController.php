<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Story;

class StoryDetailController extends Controller
{
    public function index($story_id)
    {
        $user = Auth::user();

        $story = Story::findOrFail($story_id);


        $userdetails = User::where('user_id', '!=', Auth::user()->user_id)
            ->orderBy('user_id', 'asc')
            ->get();

        return view('storydetailspage', compact('user', 'story', 'userdetails'));
    }
}
