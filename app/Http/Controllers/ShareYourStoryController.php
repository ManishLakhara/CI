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








    public function store(Request $request)
    {

        if ($request->ajax()) {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|max:40000',
                'mission_id' => 'required',
                'published_at' => 'nullable|date',
                'path' => 'nullable|array|max:20',
                'path.*' => 'required|url',
                'photos' => 'nullable|array|max:20',
                'photos.*' => 'required|image|max:4096|mimes:jpg,jpeg,png,',
            ]);

            $draft = Story::where([
                ['user_id', '=', auth()->user()->user_id],
                ['mission_id', '=', $validatedData['mission_id']],
                ['status', '=', 'DRAFT']
            ])->first();

            if ($draft) {
                $draft->title = $validatedData['title'];
                $draft->description = $validatedData['description'];
                $draft->mission_id = $validatedData['mission_id'];
                $draft->published_at = $validatedData['published_at'];
                $draft->save();

                // // Save videos
                // $draft->storyMedia()->where('type', 'video')->delete();
                // foreach ($validatedData['path'] as $video) {
                //     $media = new StoryMedia;
                //     $media->story_id = $draft->story_id;
                //     $media->type = 'video';
                //     $media->path = $video;
                //     $media->save();
                //










                // Update videos
                $existingMedia = $draft->storyMedia()->where('type', 'video')->get();
                $existingPaths = $existingMedia->pluck('path')->toArray();
                $newPaths = $validatedData['path'];

                // Find paths that have been removed
                $removedPaths = array_diff($existingPaths, $newPaths);

                // Find paths that have been added
                $addedPaths = array_diff($newPaths, $existingPaths);

                // Update existing media
                foreach ($existingMedia as $media) {
                    if (in_array($media->path, $addedPaths)) {
                        // Update the path if it was changed
                        $media->path = $newPaths[array_search($media->path, $addedPaths)];
                        $media->save();
                    } elseif (in_array($media->path, $removedPaths)) {
                        // Delete the media if the path was removed
                        $media->delete();
                    }
                }

                // Add new media
                foreach ($addedPaths as $path) {
                    if (!in_array($path, $existingPaths)) {
                        $media = new StoryMedia;
                        $media->story_id = $draft->story_id;
                        $media->type = 'video';
                        $media->path = $path;
                        $media->save();
                    }
                }

                return "Draft updated";








                //return "Draft updated";
            } else {
                $story = new Story;
                $story->title = $validatedData['title'];
                $story->description = $validatedData['description'];
                $story->mission_id = $validatedData['mission_id'];
                $story->published_at = $validatedData['published_at'];
                $story->status = 'DRAFT';
                $story->user_id = auth()->user()->user_id;
                $story->save();

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
                    $imagePath = $photo->storeAs('storage/story_media', $imageName);
                    $extension = $photo->getClientOriginalExtension();
                    $media = new StoryMedia;
                    $media->story_id = $story->story_id;
                    $media->type = $extension;
                    $media->path = $imagePath;
                    $media->save();
                }


                return "Saved to Draft";
            }
        } else {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|max:40000',
                'mission_id' => 'required',
                'published_at' => 'nullable|date',
                'path' => 'nullable|array|max:20',
                'path.*' => 'required|url',
                'photos' => 'nullable|array|max:20',
                'photos.*' => 'nullable|file|max:4096',

                //  /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/
            ]);

            $draft = Story::where([
                ['user_id', '=', auth()->user()->user_id],
                ['mission_id', '=', $validatedData['mission_id']],
                ['status', '=', 'DRAFT']
            ])->first();

            if ($draft) {
                $draft->title = $validatedData['title'];
                $draft->description = $validatedData['description'];
                $draft->mission_id = $validatedData['mission_id'];
                $draft->published_at = $validatedData['published_at'];
                $draft->status = 'PENDING';
                $draft->save();

                // // Save videos
                // $draft->storyMedia()->where('type', 'video')->delete();
                // foreach ($validatedData['path'] as $video) {
                //     $media = new StoryMedia;
                //     $media->story_id = $draft->story_id;
                //     $media->type = 'video';
                //     $media->path = $video;
                //     $media->save();
                // }









                // Update videos
                $existingMedia = $draft->storyMedia()->where('type', 'video')->get();
                $existingPaths = $existingMedia->pluck('path')->toArray();
                $newPaths = $validatedData['path'];

                // Find paths that have been removed
                $removedPaths = array_diff($existingPaths, $newPaths);

                // Find paths that have been added
                $addedPaths = array_diff($newPaths, $existingPaths);

                // Update existing media
                foreach ($existingMedia as $media) {
                    if (in_array($media->path, $addedPaths)) {
                        // Update the path if it was changed
                        $media->path = $newPaths[array_search($media->path, $addedPaths)];
                        $media->save();
                    } elseif (in_array($media->path, $removedPaths)) {
                        // Delete the media if the path was removed
                        $media->delete();
                    }
                }

                // Add new media
                foreach ($addedPaths as $path) {
                    if (!in_array($path, $existingPaths)) {
                        $media = new StoryMedia;
                        $media->story_id = $draft->story_id;
                        $media->type = 'video';
                        $media->path = $path;
                        $media->save();
                    }
                }





                return redirect()->route('landing.index')->with('success', 'Your story has been shared.');
            } else {
                $story = new Story;
                $story->title = $validatedData['title'];
                $story->description = $validatedData['description'];
                $story->mission_id = $validatedData['mission_id'];
                $story->published_at = $validatedData['published_at'];
                $story->status = 'PENDING';
                $story->user_id = auth()->user()->user_id;
                $story->save();

                // Save videos
                foreach ($validatedData['path'] as $video) {
                    $media = new StoryMedia;
                    $media->story_id = $story->story_id;
                    $media->type = 'video';
                    $media->path = $video;
                    $media->save();
                }

                return redirect()->route('landing.index')->with('success', 'Your story has been submitted for review.');
            }
        }
    }




}
