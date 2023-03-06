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

use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Mission::where([
            ['title','!=',Null],
            [function ($query) use ($request) {
                if(($s = $request->s)) {
                    $query->orWhere('title', 'LIKE', '%' . $s . '%')
                          ->orWhere('mission_type', 'LIKE', '%' . $s . '%')
                          ->get();
                }
            }]
        ])->paginate(10)
          ->appends(['s'=>$request->s]);


        //$data = MissionTheme::orderBy('mission_theme_id','desc')->paginate(10);
        return view('admin.mission.index',compact('data')); // Create view by name missiontheme/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['countries'] = Country::get(['name','country_id']);
        $data['mission_theme'] = MissionTheme::get(['title','mission_theme_id']);
        return view('admin.mission.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionRequest $request)
    {
        //dd($request);
        Mission::create($request->post());
        return redirect()->route('mission.index')->with('success','New Mission have been created');
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
        $mission=new Mission;
        $mission = $mission->find($missionId);
        $countries = Country::get(['name','country_id']);
        $mission_theme = MissionTheme::get(['title','mission_theme_id']);
        $cities=$mission->city_id;
        return view('admin.mission.edit', compact('mission', 'countries','mission_theme'));
        // Create view by name mission/edit.blade.php
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionRequest $request,$id): RedirectResponse
    {
        $mission=new Mission;
        $request->validated();
        $mission->find($id)
                     ->fill($request->post())
                     ->save();
        return redirect()->route('mission.index')->with('success','field Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $mission=new Mission;
        $mission->find($id)
                ->delete();
        return back()->with('success','field has been deleted successfully');
    }
}
