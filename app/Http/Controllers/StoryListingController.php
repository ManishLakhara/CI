<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryMedia;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;
use App\Models\MissionApplication;
use Illuminate\Support\Facades\Validator;

class StoryListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckDraftStatus')->only(['edit', 'update','updateDraft']);
    }
    public function index(Request $request)
    {

        $user = Auth::user();

        $draft_stories = Story::where('user_id', $user->user_id)->where('status', 'DRAFT')->get();

        $published_stories = Story::where('status', 'PUBLISHED')->paginate(9);
        // foreach ($published_stories as $story) {
        //     $story_media = StoryMedia::where('story_id', $story->story_id)
        //                               ->whereIn('type', ['jpg', 'jpeg', 'png'])
        //                               ->first();
        //     if ($story_media) {
        //         $story->image_path = Storage::url($story_media->path);
        //     }
        // }

        if ($request->ajax()) {
            return view('components.my-story', compact('published_stories'));
        } else {
            return view('storylisting', compact('user', 'published_stories', 'draft_stories'));
        }
    }


    public function edit($story_id)
    {
        $user = Auth::user();
        $story = Story::findOrFail($story_id);
        $storyvideoMedia = StoryMedia::where('story_id', $story_id)->where('type', 'video')->get();
        $storyimageMedia = StoryMedia::where('story_id', $story_id)->whereIn('type', ['png', 'jpg', 'jpeg'])->get();



        $appliedMissionIds = MissionApplication::where('user_id', $user->user_id)
            ->where('approval_status', 'APPROVE')
            ->pluck('mission_id')
            ->toArray();

        $appliedMissions = Mission::whereIn('mission_id', $appliedMissionIds,)->get();
        return view('edityourstory', compact('user', 'story', 'storyvideoMedia', 'appliedMissions', 'storyimageMedia'));
    }



    public function updateDraft(Request $request, $story_id)
    {
        $story = Story::findOrFail($story_id);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:40000',
            'mission_id' => 'required',
            'published_at' => 'nullable|date',
            'path' => 'array|max:20|required',
            'path.*' => 'url',
            'photos' => 'nullable|array|max:20',
            'photos.*' => 'required|image|max:4096|mimes:jpg,jpeg,png,',
        ],
               [
                'url' => 'The video URL must be a valid URL.',
                'path.max'=> 'maximum 20 URL can be uploaded',
                'mimes' => 'The :attribute field must be a file of type: :values.',
                'published_at.required' => 'The date field is required.',
                 'photos.*.max' => 'photo size should not be more then 4 MB',
                 'photos.max' => 'maximum 20 photos can be uploaded',
            ]
    );
        $story = Story::findOrFail($story_id);

        $story->title = $validatedData['title'];
        $story->description = $validatedData['description'];
        $story->mission_id = $validatedData['mission_id'];
        $story->published_at = $validatedData['published_at'];
        $story->status = 'DRAFT';
        $story->user_id = auth()->user()->user_id;
        $story->save();

        $existingMedia = $story->storyMedia()->where('type', 'video')->get();
        $existingPaths = $existingMedia->pluck('path')->toArray();
        $newPaths = $validatedData['path'];


        $removedPaths = array_diff($existingPaths, $newPaths);


        $addedPaths = array_diff($newPaths, $existingPaths);


        foreach ($existingMedia as $media) {
            if (in_array($media->path, $addedPaths)) {

                $media->path = $newPaths[array_search($media->path, $addedPaths)];
                $media->save();
            } elseif (in_array($media->path, $removedPaths)) {

                $media->delete();
            }
        }


        foreach ($addedPaths as $path) {
            if (!in_array($path, $existingPaths)) {
                $media = new StoryMedia;
                $media->story_id = $story->story_id;
                $media->type = 'video';
                $media->path = $path;
                $media->save();
            }
        }
     //dd($request->removedPhotos);

        if(isset($request->removedPhotos)){

            $story_media_ids = explode(',',$request->removedPhotos);
            foreach ($story_media_ids as $story_media_id) {
                $story_media = StoryMedia::findOrFail($story_media_id);
                $story_media->delete();
            }
        }
        if(isset($request->photos)){
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
        }
        return 'Draft Updated';
    }

    public function update(Request $request, $story_id)
    {
        $newPaths = explode("\r\n", $request->path[0]);
        $validator = Validator::make($newPaths, [
            'path.*' => 'required|url',
        ]);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|max:40000',
            'mission_id' => 'required',
            'published_at' => 'nullable|date',
            'path' => 'nullable|array|max:20',
            'photos' => 'nullable|array|max:20',
            'photos.*' => 'image|max:4096|mimes:jpg,jpeg,png,',

        ]);

        $mypaths = $validatedData['path'];
        $paths = array_filter($validatedData['path']);
        $story = Story::findOrFail($story_id);
        $story->title = $validatedData['title'];
        $story->description = $validatedData['description'];
        $story->mission_id = $validatedData['mission_id'];
        $story->published_at = $validatedData['published_at'];
        $story->status = 'PENDING';
        $story->save();

        // Update videos
        $existingMedia = $story->storyMedia()->where('type', 'video')->get();
        //dd($existingMedia);
        $existingPaths = $existingMedia->pluck('path')->toArray();
        //dd($existingPaths);
        if(isset($paths[0])){
            $newPaths = explode("\r\n", $paths[0]);
        }

        //$validatedPath =
            //  dd($newPaths);
            // Find paths that have been removed
            $removedPaths = array_diff($existingPaths, $newPaths);
        // dd($removedPaths);

        // Find paths that have been added
        $addedPaths = array_diff($newPaths, $existingPaths);
        // dd($addedPaths);
        // Update existing media
        foreach ($existingMedia as $media) {
            if (in_array($media->path, $addedPaths)) {
                // Update the path if it was changed
                $media->path = $newPaths[array_search($media->path, $addedPaths)];
                $media->save();
            } elseif (in_array($media->path, $removedPaths)) {
                $media->delete();
            }
        }

        // Add new media
        foreach ($addedPaths as $path) {
            if (!in_array($path, $existingPaths)) {
                $media = new StoryMedia;
                $media->story_id = $story->story_id;
                $media->type = 'video';
                $media->path = $path;
                $media->save();
            }
        }
        if(isset($request->removedPhotos)){
            $story_media_ids = explode(',',$request->removedPhotos);
            foreach ($story_media_ids as $story_media_id) {
                $story_media = StoryMedia::findOrFail($story_media_id);
                $story_media->delete();
            }
        }
        //dd($request->photos);
        if(isset($request->photos)){
            foreach($validatedData['photos'] as $photo){
                $imageName = $photo->getClientOriginalName();
                $imagePath = $photo->storeAs('storage/story_media', $imageName, 'public');
                $extension = $photo->getClientOriginalExtension();
                $media = new StoryMedia;
                $media->story_id = $story_id;
                $media->type = $extension;
                $media->path = $imagePath;
                $media->save();
            }
        }
        return redirect()->route('mystories.index')->with('success', 'Your story has been Updated.');
    }
}
