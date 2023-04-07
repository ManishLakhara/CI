<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Story;
class StoryDetailController extends Controller
{
    public function index($story_id){
        $user = Auth::user();

        $story= Story::findOrFail($story_id);


        return view('storydetailspage',compact('user','story'));
    }
}
