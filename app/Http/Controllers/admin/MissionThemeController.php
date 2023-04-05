<?php

namespace App\Http\Controllers\admin;

use App\Models\MissionTheme;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionThemeRequest;
use App\Http\Requests\UpdateMissionThemeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

class MissionThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = MissionTheme::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('title', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('mission_theme_id', 'desc')
            ->paginate(10)
            ->appends(['s' => $request->s]);


        //$data = MissionTheme::orderBy('mission_theme_id','desc')->paginate(10);
        return view('admin.missiontheme.index', compact('data')); // Create view by name missiontheme/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.missiontheme.create'); // Create view by name missiontheme/create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionThemeRequest $request) : RedirectResponse
    {
        $request->validated();

        MissionTheme::create($request->post());

        return redirect()->route('missiontheme.index')->with('success', 'field has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MissionTheme $missionTheme)
    {
        return view('admin.missiontheme.edit', compact('missionTheme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MissionTheme $missionTheme, $missionThemeId)
    {
        $missionTheme = $missionTheme->find($missionThemeId);
        return view('admin.missiontheme.edit', compact('missionTheme'));
        // Create view by name missiontheme/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionThemeRequest $request, MissionTheme $missionTheme, $id) : RedirectResponse
    {

        $request->validated();
        $missionTheme->find($id)
            ->fill($request->post())
            ->save();
        return redirect()->route('missiontheme.index')->with('success', 'field Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MissionTheme $missionTheme, $id) : RedirectResponse
    {
        $missionTheme->find($id)
            ->delete();
        return back()->with('success', 'field has been deleted successfully');
    }
}
