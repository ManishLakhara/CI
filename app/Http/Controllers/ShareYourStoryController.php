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



        $sharedMissionIds = Story::where('user_id', $user->user_id)
            ->pluck('mission_id')
            ->toArray();


        $appliedMissionIds = MissionApplication::where('user_id', $user->user_id)
            ->where('approval_status', 'APPROVE')
            ->pluck('mission_id')
            ->toArray();

        // $appliedMissions = Mission::whereIn('mission_id', $appliedMissionIds,)->get();


        $appliedMissions = Mission::whereIn('mission_id', $appliedMissionIds)
            ->whereNotIn('mission_id', $sharedMissionIds)
            ->get();





        return view('shareyourstory', compact('user',  'appliedMissionIds', 'appliedMissions'));
    }








    public function store(Request $request)
    {

        if ($request->ajax()) {
            dd($request['photos']);
            $validatedData = $request->validate(
                [
                    'title' => 'required|string|max:255',
                    'description' => 'required|max:40000',
                    'mission_id' => 'required',
                    'published_at' => 'required|date',
                    'path' => 'nullable|array|max:20',

                    'path.*' => [
                        'required',
                        'url',
                        'regex:/^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i'
                    ],
                    'photos' => 'array|max:20|min:1',
                    'photos.*' => 'image|max:4096|mimes:jpg,jpeg,png,',
                ],
                [
                    'url' => 'The video URL must be a valid URL.',
                    'path.max' => 'maximum 20 URL can be uploaded',
                    'mimes' => 'The :attribute field must be a file of type: :values.',
                    'published_at.required' => 'The date field is required.',
                    'photos.*' => 'photo size should not be more then 4 MB',
                    'photos.max' => 'maximum 20 photos can be uploaded',
                    'path.*.regex' => 'please enter a valid youtube URL on index :index of the video URL'
                ]
            );




            $story = new Story;
            $story->title = $validatedData['title'];
            $story->description = $validatedData['description'];
            $story->mission_id = $validatedData['mission_id'];
            $story->published_at = $validatedData['published_at'];
            $story->status = 'DRAFT';
            $story->user_id = auth()->user()->user_id;
            $story->save();
            $story_id = $story->story_id;

            // Save videos
            foreach ($validatedData['path'] as $video) {
                $media = new StoryMedia;
                $media->story_id = $story->story_id;
                $media->type = 'video';
                $media->path = $video;
                $media->save();
            }

            foreach ($validatedData['photos'] as $photo) {
                $imageName = $photo->getClientOriginalName();
                $imagePath = $photo->storeAs('storage/story_media', $imageName, 'public');
                $extension = $photo->getClientOriginalExtension();
                $media = new StoryMedia;
                $media->story_id = $story->story_id;
                $media->type = $extension;
                $media->path = $imagePath;
                $media->save();
            }


            return $story_id;
        }
    }
}
