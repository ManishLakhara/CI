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





    // public function store(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'required|max:40000',
    //             'mission_id' => 'required',
    //             'published_at' => 'nullable|date',
    //         ]);

    //         $draft = Story::where([
    //             ['user_id', '=', auth()->user()->user_id],
    //             ['mission_id', '=', $validatedData['mission_id']],
    //             ['status', '=', 'DRAFT']
    //         ])->first();

    //         if ($draft) {
    //             $draft->title = $validatedData['title'];
    //             $draft->description = $validatedData['description'];
    //             $draft->mission_id = $validatedData['mission_id'];
    //             $draft->published_at = $validatedData['published_at'];
    //             $draft->save();

    //             return "Draft updated";
    //         } else {
    //             $story = new Story;
    //             $story->title = $validatedData['title'];
    //             $story->description = $validatedData['description'];
    //             $story->mission_id = $validatedData['mission_id'];
    //             $story->published_at = $validatedData['published_at'];
    //             $story->status = 'DRAFT';
    //             $story->user_id = auth()->user()->user_id;
    //             $story->save();

    //             return "Saved to Draft";
    //         }
    //     } else {
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'required|max:40000',
    //             'mission_id' => 'required',
    //             'published_at' => 'nullable|date',
    //         ]);

    //         $draft = Story::where([
    //             ['user_id', '=', auth()->user()->user_id],
    //             ['mission_id', '=', $validatedData['mission_id']],
    //             ['status', '=', 'DRAFT']
    //         ])->first();

    //         if ($draft) {
    //             $draft->title = $validatedData['title'];
    //             $draft->description = $validatedData['description'];
    //             $draft->mission_id = $validatedData['mission_id'];
    //             $draft->published_at = $validatedData['published_at'];
    //             $draft->status = 'PENDING';
    //             $draft->save();

    //             return redirect()->route('landing.index')->with('success', 'Story shared successfully!');
    //         } else {
    //             $story = new Story;
    //             $story->title = $validatedData['title'];
    //             $story->description = $validatedData['description'];
    //             $story->mission_id = $validatedData['mission_id'];
    //             $story->published_at = $validatedData['published_at'];
    //             $story->status = 'PENDING';
    //             $story->user_id = auth()->user()->user_id;
    //             $story->save();

    //             return redirect()->route('landing.index')->with('success', 'Story shared successfully!');
    //         }
    //     }
    // }

//original controller code
    // public function store(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'required|max:40000',
    //             'mission_id' => 'required',
    //             'published_at' => 'nullable|date',
    //             'path' => 'nullable|array|max:20',
    //             'path.*' => 'required|url',
    //         ]);

    //         $draft = Story::where([
    //             ['user_id', '=', auth()->user()->user_id],
    //             ['mission_id', '=', $validatedData['mission_id']],
    //             ['status', '=', 'DRAFT']
    //         ])->first();

    //         if ($draft) {
    //             $draft->title = $validatedData['title'];
    //             $draft->description = $validatedData['description'];
    //             $draft->mission_id = $validatedData['mission_id'];
    //             $draft->published_at = $validatedData['published_at'];
    //             $draft->save();

    //             // // Save videos
    //             // $draft->storyMedia()->where('type', 'video')->delete();
    //             // foreach ($validatedData['path'] as $video) {
    //             //     $media = new StoryMedia;
    //             //     $media->story_id = $draft->story_id;
    //             //     $media->type = 'video';
    //             //     $media->path = $video;
    //             //     $media->save();
    //             // }












    //             // Update videos
    //             $existingMedia = $draft->storyMedia()->where('type', 'video')->get();
    //             $existingPaths = $existingMedia->pluck('path')->toArray();
    //             $newPaths = $validatedData['path'];

    //             // Find paths that have been removed
    //             $removedPaths = array_diff($existingPaths, $newPaths);

    //             // Find paths that have been added
    //             $addedPaths = array_diff($newPaths, $existingPaths);

    //             // Update existing media
    //             foreach ($existingMedia as $media) {
    //                 if (in_array($media->path, $addedPaths)) {
    //                     // Update the path if it was changed
    //                     $media->path = $newPaths[array_search($media->path, $addedPaths)];
    //                     $media->save();
    //                 } elseif (in_array($media->path, $removedPaths)) {
    //                     // Delete the media if the path was removed
    //                     $media->delete();
    //                 }
    //             }

    //             // Add new media
    //             foreach ($addedPaths as $path) {
    //                 if (!in_array($path, $existingPaths)) {
    //                     $media = new StoryMedia;
    //                     $media->story_id = $draft->story_id;
    //                     $media->type = 'video';
    //                     $media->path = $path;
    //                     $media->save();
    //                 }
    //             }

    //             return "Draft updated";








    //             //return "Draft updated";
    //         } else {
    //             $story = new Story;
    //             $story->title = $validatedData['title'];
    //             $story->description = $validatedData['description'];
    //             $story->mission_id = $validatedData['mission_id'];
    //             $story->published_at = $validatedData['published_at'];
    //             $story->status = 'DRAFT';
    //             $story->user_id = auth()->user()->user_id;
    //             $story->save();

    //             // Save videos
    //             foreach ($validatedData['path'] as $video) {
    //                 $media = new StoryMedia;
    //                 $media->story_id = $story->story_id;
    //                 $media->type = 'video';
    //                 $media->path = $video;
    //                 $media->save();
    //             }

    //             return "Saved to Draft";
    //         }
    //     } else {
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'required|max:40000',
    //             'mission_id' => 'required',
    //             'published_at' => 'nullable|date',
    //             'path' => 'nullable|array|max:20',
    //             'path.*' => 'required|url'

    //             //  /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/
    //         ]);

    //         $draft = Story::where([
    //             ['user_id', '=', auth()->user()->user_id],
    //             ['mission_id', '=', $validatedData['mission_id']],
    //             ['status', '=', 'DRAFT']
    //         ])->first();

    //         if ($draft) {
    //             $draft->title = $validatedData['title'];
    //             $draft->description = $validatedData['description'];
    //             $draft->mission_id = $validatedData['mission_id'];
    //             $draft->published_at = $validatedData['published_at'];
    //             $draft->status = 'PENDING';
    //             $draft->save();

    //             // // Save videos
    //             // $draft->storyMedia()->where('type', 'video')->delete();
    //             // foreach ($validatedData['path'] as $video) {
    //             //     $media = new StoryMedia;
    //             //     $media->story_id = $draft->story_id;
    //             //     $media->type = 'video';
    //             //     $media->path = $video;
    //             //     $media->save();
    //             // }






    //             // Update videos
    //             $existingMedia = $draft->storyMedia()->where('type', 'video')->get();
    //             $existingPaths = $existingMedia->pluck('path')->toArray();
    //             $newPaths = $validatedData['path'];

    //             // Find paths that have been removed
    //             $removedPaths = array_diff($existingPaths, $newPaths);

    //             // Find paths that have been added
    //             $addedPaths = array_diff($newPaths, $existingPaths);

    //             // Update existing media
    //             foreach ($existingMedia as $media) {
    //                 if (in_array($media->path, $addedPaths)) {
    //                     // Update the path if it was changed
    //                     $media->path = $newPaths[array_search($media->path, $addedPaths)];
    //                     $media->save();
    //                 } elseif (in_array($media->path, $removedPaths)) {
    //                     // Delete the media if the path was removed
    //                     $media->delete();
    //                 }
    //             }

    //             // Add new media
    //             foreach ($addedPaths as $path) {
    //                 if (!in_array($path, $existingPaths)) {
    //                     $media = new StoryMedia;
    //                     $media->story_id = $draft->story_id;
    //                     $media->type = 'video';
    //                     $media->path = $path;
    //                     $media->save();
    //                 }
    //             }





    //             return redirect()->route('landing.index')->with('success', 'Your story has been shared.');
    //         } else {
    //             $story = new Story;
    //             $story->title = $validatedData['title'];
    //             $story->description = $validatedData['description'];
    //             $story->mission_id = $validatedData['mission_id'];
    //             $story->published_at = $validatedData['published_at'];
    //             $story->status = 'PENDING';
    //             $story->user_id = auth()->user()->user_id;
    //             $story->save();

    //             // Save videos
    //             foreach ($validatedData['path'] as $video) {
    //                 $media = new StoryMedia;
    //                 $media->story_id = $story->story_id;
    //                 $media->type = 'video';
    //                 $media->path = $video;
    //                 $media->save();
    //             }

    //             return redirect()->route('landing.index')->with('success', 'Your story has been submitted for review.');
    //         }
    //     }
    // }

    //testing controller code
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
                // }






// Update photos
$existingPhotos = $draft->storyMedia()->where('type', 'photo')->get();
$existingPaths = $existingPhotos->pluck('path')->toArray();
$newPhotos = $request->file('photos');

// Find paths that have been removed
$removedPaths = array_diff($existingPaths, $validatedData['removephotos']);

// Find paths that have been added
$addedPhotos = [];
if ($newPhotos) {
    foreach ($newPhotos as $photo) {
        $imageName = $photo->getClientOriginalName();
        $imagePath = $photo->storeAs('storage/story_media',$imageName);
        $extension = $photo->getClientOriginalExtension();
        $addedPhotos[] = $imagePath;
        $media = new StoryMedia;
        $media->story_id = $draft->story_id;
        $media->type = $extension;
        $media->path = $imagePath;
        $media->save();
    }
}

// Update existing photos
foreach ($existingPhotos as $media) {
    if (in_array($media->path, $addedPhotos)) {
        // Update the path if it was changed
        $media->path = $addedPhotos[array_search($media->path, $addedPhotos)];
        $media->save();
    } elseif (in_array($media->path, $removedPaths)) {
        // Delete the media if the path was removed
        $media->delete();
    }
}

return "Draft updated";


















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
                    $imagePath = $photo->storeAs('storage/story_media',$imageName);
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



    // public function store(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'required|max:40000',
    //             'mission_id' => 'required',
    //             'published_at' => 'nullable|date',
    //             'path' => 'nullable|array|max:20',
    //             'path.*' => 'required|url',
    //             'photos' => 'nullable',
    //             'photos.*' => 'required|image|max:4096|mimes:jpg,jpeg,png,',
    //         ]);

    //         $draft = Story::where([
    //             ['user_id', '=', auth()->user()->user_id],
    //             ['mission_id', '=', $validatedData['mission_id']],
    //             ['status', '=', 'DRAFT']
    //         ])->first();

    //         if ($draft) {
    //             $draft->title = $validatedData['title'];
    //             $draft->description = $validatedData['description'];
    //             $draft->mission_id = $validatedData['mission_id'];
    //             $draft->published_at = $validatedData['published_at'];
    //             $draft->save();




    //             //update photos
    //             $existingPhotosMedia = $draft->storyMedia()->whereIn('type', ['jpg', 'jpeg', 'png'])->get();
    //             $existingPhotosPaths = $existingPhotosMedia->pluck('path')->toArray();
    //             $newPhotosPaths = $validatedData['path'];

    //             $removedPhotosPaths = array_diff($existingPhotosPaths, $newPhotosPaths);

    //             // Find paths that have been added
    //             $addedPhotosPaths = array_diff($newPhotosPaths, $existingPhotosPaths);

    //             // Update existing media
    //             foreach ($existingPhotosMedia as $Photosmedia) {
    //                 if (in_array($Photosmedia->path, $addedPhotosPaths)) {
    //                     // Update the path if it was changed
    //                     $Photosmedia->path = $newPhotosPaths[array_search($Photosmedia->path, $addedPhotosPaths)];
    //                     $Photosmedia->save();
    //                 } elseif (in_array($Photosmedia->path, $removedPhotosPaths)) {
    //                     // Delete the media if the path was removed
    //                     $Photosmedia->delete();
    //                 }
    //             }

    //             // Add new media
    //             foreach ($addedPhotosPaths as $imagepath) {
    //                 if (!in_array($imagepath, $existingPhotosPaths)) {
    //                     $imageName =  $imagepath->getClientOriginalName();
    //                     $path = $imagepath->storeAs('storage/story_media', $imageName);
    //                     $media = new StoryMedia;
    //                     $media->story_id = $draft->story_id;
    //                     $media->type =  $imagepath->getClientOriginalExtension();
    //                     $media->path = $path;
    //                     $media->save();
    //                 }
    //             }





    //             // Update videos
    //             $existingMedia = $draft->storyMedia()->where('type', 'video')->get();
    //             $existingPaths = $existingMedia->pluck('path')->toArray();
    //             $newPaths = $validatedData['path'];

    //             // Find paths that have been removed
    //             $removedPaths = array_diff($existingPaths, $newPaths);

    //             // Find paths that have been added
    //             $addedPaths = array_diff($newPaths, $existingPaths);

    //             // Update existing media
    //             foreach ($existingMedia as $media) {
    //                 if (in_array($media->path, $addedPaths)) {
    //                     // Update the path if it was changed
    //                     $media->path = $newPaths[array_search($media->path, $addedPaths)];
    //                     $media->save();
    //                 } elseif (in_array($media->path, $removedPaths)) {
    //                     // Delete the media if the path was removed
    //                     $media->delete();
    //                 }
    //             }

    //             // Add new media
    //             foreach ($addedPaths as $path) {
    //                 if (!in_array($path, $existingPaths)) {
    //                     $media = new StoryMedia;
    //                     $media->story_id = $draft->story_id;
    //                     $media->type = 'video';
    //                     $media->path = $path;
    //                     $media->save();
    //                 }
    //             }

    //             return "Draft updated";








    //             //return "Draft updated";
    //         } else {
    //             $story = new Story;
    //             $story->title = $validatedData['title'];
    //             $story->description = $validatedData['description'];
    //             $story->mission_id = $validatedData['mission_id'];
    //             $story->published_at = $validatedData['published_at'];
    //             $story->status = 'DRAFT';
    //             $story->user_id = auth()->user()->user_id;
    //             $story->save();

    //             // Save videos
    //             foreach ($validatedData['path'] as $video) {
    //                 $media = new StoryMedia;
    //                 $media->story_id = $story->story_id;
    //                 $media->type = 'video';
    //                 $media->path = $video;
    //                 $media->save();
    //             }

    //             foreach ($validatedData['photos'] as $photo) {
    //                 $photoName =  $photo->getClientOriginalName();
    //                 $path = $photo->storeAs('storage/story_media', $photoName);
    //                 $media = new StoryMedia;
    //                 $media->story_id = $story->story_id;
    //                 $media->type = $photo->getClientOriginalExtension();
    //                 $media->path = $path;
    //                 $media->save();
    //             }



    //             return "Saved to Draft";
    //         }
    //     } else {
    //         $validatedData = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'required|max:40000',
    //             'mission_id' => 'required',
    //             'published_at' => 'nullable|date',
    //             'path' => 'nullable|array|max:20',
    //             'path.*' => 'required|url',
    //             'photos' => 'nullable',
    //             'photos.*' => 'required|image|max:4096|mimes:jpg,jpeg,png,',
    //             'photos' => 'nullable',
    //             'photos.*' => 'required|image|max:4096|mimes:jpg,jpeg,png,',
    //         ]);

    //         $draft = Story::where([
    //             ['user_id', '=', auth()->user()->user_id],
    //             ['mission_id', '=', $validatedData['mission_id']],
    //             ['status', '=', 'DRAFT']
    //         ])->first();

    //         if ($draft) {
    //             $draft->title = $validatedData['title'];
    //             $draft->description = $validatedData['description'];
    //             $draft->mission_id = $validatedData['mission_id'];
    //             $draft->published_at = $validatedData['published_at'];
    //             $draft->status = 'PENDING';
    //             $draft->save();






    //             //update photos
    //             $existingPhotosMedia = $draft->storyMedia()->whereIn('type', ['jpg', 'jpeg', 'png'])->get();
    //             $existingPhotosPaths = $existingPhotosMedia->pluck('path')->toArray();
    //             $newPhotosPaths = $validatedData['path'];

    //             $removedPhotosPaths = array_diff($existingPhotosPaths, $newPhotosPaths);

    //             // Find paths that have been added
    //             $addedPhotosPaths = array_diff($newPhotosPaths, $existingPhotosPaths);

    //             // Update existing media
    //             foreach ($existingPhotosMedia as $Photosmedia) {
    //                 if (in_array($Photosmedia->path, $addedPhotosPaths)) {
    //                     // Update the path if it was changed
    //                     $Photosmedia->path = $newPhotosPaths[array_search($Photosmedia->path, $addedPhotosPaths)];
    //                     $Photosmedia->save();
    //                 } elseif (in_array($Photosmedia->path, $removedPhotosPaths)) {
    //                     // Delete the media if the path was removed
    //                     $Photosmedia->delete();
    //                 }
    //             }

    //             // Add new media
    //             foreach ($addedPhotosPaths as $imagepath) {
    //                 if (!in_array($imagepath, $existingPhotosPaths)) {
    //                     $imageName =  $imagepath->getClientOriginalName();
    //                     $path = $imagepath->storeAs('storage/story_media', $imageName);
    //                     $media = new StoryMedia;
    //                     $media->story_id = $draft->story_id;
    //                     $media->type =  $imagepath->getClientOriginalExtension();
    //                     $media->path = $path;
    //                     $media->save();
    //                 }
    //             }




    //             // Update videos
    //             $existingMedia = $draft->storyMedia()->where('type', 'video')->get();
    //             $existingPaths = $existingMedia->pluck('path')->toArray();
    //             $newPaths = $validatedData['path'];

    //             // Find paths that have been removed
    //             $removedPaths = array_diff($existingPaths, $newPaths);

    //             // Find paths that have been added
    //             $addedPaths = array_diff($newPaths, $existingPaths);

    //             // Update existing media
    //             foreach ($existingMedia as $media) {
    //                 if (in_array($media->path, $addedPaths)) {
    //                     // Update the path if it was changed
    //                     $media->path = $newPaths[array_search($media->path, $addedPaths)];
    //                     $media->save();
    //                 } elseif (in_array($media->path, $removedPaths)) {
    //                     // Delete the media if the path was removed
    //                     $media->delete();
    //                 }
    //             }

    //             // Add new media
    //             foreach ($addedPaths as $path) {
    //                 if (!in_array($path, $existingPaths)) {
    //                     $media = new StoryMedia;
    //                     $media->story_id = $draft->story_id;
    //                     $media->type = 'video';
    //                     $media->path = $path;
    //                     $media->save();
    //                 }
    //             }





    //             return redirect()->route('landing.index')->with('success', 'Your story has been shared.');
    //         } else {
    //             $story = new Story;
    //             $story->title = $validatedData['title'];
    //             $story->description = $validatedData['description'];
    //             $story->mission_id = $validatedData['mission_id'];
    //             $story->published_at = $validatedData['published_at'];
    //             $story->status = 'PENDING';
    //             $story->user_id = auth()->user()->user_id;
    //             $story->save();


    //             foreach ($validatedData['photos'] as $photo) {
    //                 $photoName =  $photo->getClientOriginalName();
    //                 $path = $photo->storeAs('storage/story_media', $photoName);
    //                 $media = new StoryMedia;
    //                 $media->story_id = $story->story_id;
    //                 $media->type = $photo->getClientOriginalExtension();
    //                 $media->path = $path;
    //                 $media->save();
    //             }


    //             // Save videos
    //             foreach ($validatedData['path'] as $video) {
    //                 $media = new StoryMedia;
    //                 $media->story_id = $story->story_id;
    //                 $media->type = 'video';
    //                 $media->path = $video;
    //                 $media->save();
    //             }

    //             return redirect()->route('landing.index')->with('success', 'Your story has been submitted for review.');
    //         }
    //     }
    // }
}
