<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryMedia;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class StoryListingController extends Controller
{

    public function index(Request $request){

        $user = Auth::user();

        $published_stories = Story::where('status', 'PUBLISHED')->paginate(3);
        // foreach ($published_stories as $story) {
        //     $story_media = StoryMedia::where('story_id', $story->story_id)
        //                               ->whereIn('type', ['jpg', 'jpeg', 'png'])
        //                               ->first();
        //     if ($story_media) {
        //         $story->image_path = Storage::url($story_media->path);
        //     }
        // }

        if($request->ajax()){
            return view('components.my-story', compact('published_stories'));
        }else{
            return view('storylisting',compact('user','published_stories'));
        }

    }
}
