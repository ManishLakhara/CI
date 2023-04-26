<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Country;
use App\Models\City;
use App\Models\MissionDocument;
use App\Models\MissionMedia;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Skill;
use App\Models\MissionSkill;
use App\Models\GoalMission;
use App\Models\TimeMission;
use Illuminate\Pagination\LengthAwarePaginator;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Mission::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('title', 'LIKE', '%' . $s . '%')
                        ->orWhere('mission_type', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderByDesc('mission_id')->paginate(10);

        $pagination = $data->links()->render();
        if($data instanceof LengthAwarePaginator) {
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }

        //$data = MissionTheme::orderBy('mission_theme_id','desc')->paginate(10);
        return view('admin.mission.index', compact('data','pagination')); // Create view by name missiontheme/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['countries'] = Country::get(['name', 'country_id']);
        $data['mission_theme'] = MissionTheme::get(['title', 'mission_theme_id']);
        $data['mission_skills'] = Skill::get(['skill_id', 'skill_name']);
        return view('admin.mission.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionRequest $request)
    {

        //dd($request);
        $mission = Mission::create($request->post());
        // $document_path = $request->file('document_name')->store('mission_documents');

        // // Get the document type from the file extension
        // $document_type = $request->file('document_name')->getClientOriginalExtension();

        // // Create a new mission document record in the database
        // $mission_document = new MissionDocument([
        //     'document_name' => $request->file('document_name')->getClientOriginalName(),
        //     'document_type' => $document_type,
        //     'document_path' => $document_path
        // ]);
        // // $mission_document->save();
        // $mission->missionDocument()->save($mission_document);



        if ($request->hasfile('document_name')) {
            foreach ($request->file('document_name') as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uniqueName = uniqid() . '_' . $fileName;
                $file->storeAs('missions_documents', $uniqueName, 'public');
                MissionDocument::create([
                    'mission_id' => $mission->mission_id,
                    'document_name' => $uniqueName,
                    'document_type' => $extension,
                    'document_path' => 'storage/missions_documents/' . $uniqueName,
                ]);
            }
        }

        //  mission images code
        $images = $request->file('media_name');
        if ($images) {
            foreach ($images as $key => $image) {
                // generating unique name for the image with uniqueid
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                // save image to storage/mission_media directory with the above generated name
                $imagePath = $image->storeAs('mission_media', $imageName, 'public');

                // get file extension
                $extension = $image->getClientOriginalExtension();

               //saving in database
                $missionMedia = new MissionMedia([
                    'mission_id' => $mission->mission_id,
                    'media_name' => $image->getClientOriginalName(),
                    'media_type' => $extension,
                    'media_path' => $imagePath,
                    'default' => ($key == 0 ? 1 : 0) // mark first image as default
                ]);

                $missionMedia->save();
            }
        }


        // mission video code
        $videoUrl = $request->input('media_names');
        if ($videoUrl) {
            // check if youtube url is valid
            $pattern = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
            if (preg_match($pattern, $videoUrl)) {
                // create mission media entry for the video
                $missionMedia = new MissionMedia([
                    'mission_id' => $mission->mission_id,
                    'media_name' => 'youtube',
                    'media_type' => 'MP4',
                    'media_path' => $videoUrl,
                    'default' => 1 // mark first video as default
                ]);

                $missionMedia->save();
            }
        }

       // mission skill code
        foreach ($request->input('skill_id') as $skill_id) {
            $missionSkill = new MissionSkill([
                'skill_id' => $skill_id,
                'mission_id' => $mission->mission_id,
            ]);
            $missionSkill->save();
        }
        if ($request->get('mission_type') === 'goal') {
            $goalMission = new GoalMission([
                'goal_objective_text' => $request->input('goal_objective_text'),
                'goal_value' => $request->input('goal_value'),
                'mission_id' => $mission->mission_id,
            ]);

            $goalMission->save();
        }
        if ($request->get('mission_type') === 'time') {
            $timeMission = new TimeMission([
                'total_seats' => $request->input('total_seats'),
                'registration_deadline' => $request->input('registration_deadline'),
                'mission_id' => $mission->mission_id,
            ]);

            $timeMission->save();
        }

        return redirect()->route('mission.index')->with('success', 'New Mission have been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        return view('admin.mission.edit', compact('mission'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($missionId)
    {
        $mission = new Mission;
        $mission = $mission->find($missionId);
        $countries = Country::get(['name', 'country_id']);
        $cities = City::where("country_id", $mission->country_id)->get();
        $mission_theme = MissionTheme::get(['title', 'mission_theme_id']);

        $mission_skills = Skill::get(['skill_id', 'skill_name']);
        $selected_skills = MissionSkill::where(['mission_id' => $missionId])->get();
        $missionVideo = MissionMedia::where(['mission_id' => $missionId, 'media_name' => 'youtube'])->get();
        $missionImages = MissionMedia::where([
            'mission_id' => $missionId,
            // 'media_type' => 'png'
        ])->whereIn('media_type', ['png', 'jpeg', 'jpg'])->get();
        $missionDocuments = MissionDocument::where([
            'mission_id' => $missionId,
        ])->get();
        $goalMission = $mission->goalMission;
        $timeMission = $mission->timeMission;

        return view('admin.mission.edit', compact('mission', 'countries', 'mission_theme', 'cities', 'mission_skills', 'selected_skills', 'missionVideo', 'missionImages', 'missionDocuments', 'goalMission', 'timeMission'));
        // Create view by name mission/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionRequest $request, $id)
    {
        //dd($request->toArray());
        // $mission=new Mission;
        // $request->validated();
        // $mission->find($id)
        //              ->fill($request->post())
        //              ->save();
        //              dd($mission->mission_type);
        // return redirect()->route('mission.index')->with('success','field Has Been updated successfully');
        //dd($request->post('total_seats'));
        $mission = Mission::find($id);
        $currentMissionType = $mission->mission_type;
        //dd($currentMissionType);
        $newMissionType = $request->post('mission_type');
        //dd($newMissionType);
        $mission->fill($request->post())->save();


        // $mission->update($request->all());

    if ($currentMissionType == $newMissionType) {
        if ($currentMissionType === 'TIME') {
            $timeMission = TimeMission::where('mission_id', $id)->first();
            if ($timeMission) {
                $timeMission->fill([
                    'mission_id' => $mission->mission_id,
                    'total_seats' => $request->post('total_seats'),
                    'registration_deadline' => $request->post('registration_deadline'),
                ])->save();
            }
        } elseif ($currentMissionType === 'GOAL') {
            $goalMission = GoalMission::where('mission_id', $id)->first();
            if ($goalMission) {
                $goalMission->fill([
                    'mission_id' => $mission->mission_id,
                    'goal_objective_text' => $request->post('goal_objective_text'),
                    'goal_value' => $request->post('goal_value'),
                ])->save();
            }
        }
    }

    // Move mission data between tables based on mission type change
    if ($currentMissionType !== $newMissionType) {
        if ($currentMissionType === 'TIME') {
            $timeMission = TimeMission::where('mission_id', $id)->first();
            $goalMission = new GoalMission();
            $goalMission->fill([
                'mission_id' => $mission->mission_id,
                'goal_objective_text' => $request->post('goal_objective_text'),
                'goal_value' => $request->post('goal_value'),
            ])->save();

            if ($timeMission) {
                $timeMission->delete();
            }
        } elseif ($currentMissionType === 'GOAL') {
            $goalMission = GoalMission::where('mission_id', $id)->first();
            $timeMission = new TimeMission();
            $timeMission->fill([
                'mission_id' => $mission->mission_id,
                'total_seats' => $request->post('total_seats'),
                'registration_deadline' => $request->post('registration_deadline'),
            ])->save();

            if ($goalMission) {
                $goalMission->delete();
            }
        }
    }
        $selectedDocuments = $request->input('selected_documents', []);
        $documentsToDelete = array_diff($mission->missionDocument()->pluck('document_name')->toArray(), $selectedDocuments);

        if (!empty($documentsToDelete)) {
            foreach ($documentsToDelete as $documentToDelete) {
                $document = $mission->missionDocument()->where('document_name', $documentToDelete)->firstOrFail();
                Storage::delete('public/' . $document->document_path);
                $document->delete();
            }
        }

        if ($request->hasfile('document_name')) {
            foreach ($request->file('document_name') as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $uniqueName = uniqid() . '_' . $fileName;
                $file->storeAs('missions_documents', $uniqueName, 'public');
                MissionDocument::create([
                    'mission_id' => $mission->mission_id,
                    'document_name' => $uniqueName,
                    'document_type' => $extension,
                    'document_path' => 'storage/missions_documents/' . $uniqueName,
                ]);
            }
        }

        // handle mission images
        $selectedMedia = $request->input('selected_media', []);
        $missionImages = MissionMedia::where('mission_id', $id)->get();

        foreach ($missionImages as $image) {
            if (!in_array($image->media_name, $selectedMedia)) {
                Storage::delete('public/' . $image->media_path);
                $image->delete();
            }
        }

        $images = $request->file('media_name');
        if ($images) {
            foreach ($images as $key => $image) {
                // giving unique name for the image
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                // save image to storage/mission_media directory with the image name
                $imagePath = $image->storeAs('mission_media', $imageName, 'public');

                // get file extension
                $extension = $image->getClientOriginalExtension();

                // create mission media entry for the image
                $missionMedia = new MissionMedia([
                    'mission_id' => $mission->mission_id,
                    'media_name' => $image->getClientOriginalName(),
                    'media_type' => $extension,
                    'media_path' => $imagePath,
                    'default' => ($key == 0 ? 1 : 0) // mark first image as default
                ]);

                $missionMedia->save();
            }
        }

         $videoUrl = $request->input('media_names');
        if ($videoUrl) {
            // checking youtube url is valid
            $pattern = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
            if (preg_match($pattern, $videoUrl)) {
                // creating mission media entry for  video
                $missionMedia = new MissionMedia([
                    'mission_id' => $mission->mission_id,
                    'media_name' => 'youtube',
                    'media_type' => 'MP4',
                    'media_path' => $videoUrl,
                    'default' => 1
                ]);

                $missionMedia->save();
            }
        }

        // Update the mission skills
        $selected_skills = $request->input('skill_id');

        // Delete the unselected skills
        $unselected_skills = MissionSkill::where('mission_id', $mission->mission_id)
            ->whereNotIn('skill_id', $selected_skills)
            ->delete();

        // Insert the new selected skills
        foreach ($selected_skills as $skill_id) {
            $missionSkill = MissionSkill::where('mission_id', $mission->mission_id)
                ->where('skill_id', $skill_id)
                ->first();

            if (!$missionSkill) {
                $missionSkill = new MissionSkill([
                    'skill_id' => $skill_id,
                    'mission_id' => $mission->mission_id,
                ]);
                $missionSkill->save();
            }
        }

        return redirect()->route('mission.index')->with('success', 'Field has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $mission = new Mission;

        // $mission->find($id)->delete();
        $mission = Mission::findOrFail($id);
        $missionDocuments = MissionDocument::where('mission_id', $mission->mission_id)->get();
        $missionMedia = MissionMedia::where('mission_id', $mission->mission_id)->get();
        $missionSkills = MissionSkill::where('mission_id', $mission->mission_id)->delete();
        foreach ($missionDocuments as $document) {
            Storage::delete('public/' . $document->document_name);
            $document->delete();
        }
        foreach ($missionMedia as $media) {
            Storage::delete('public/' . $media->media_name);
            $media->delete();
        }

        $mission->delete();

        return back()->with('success', 'field has been deleted successfully');
    }
}
