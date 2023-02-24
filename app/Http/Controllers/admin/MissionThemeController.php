<?php

namespace App\Http\Controllers\admin;

use App\Models\MissionTheme;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionThemeRequest;
use App\Http\Requests\UpdateMissionThemeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class MissionThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MissionTheme::orderBy('mission_theme_id','desc')->paginate(10);
        return view('admin.missiontheme.index',compact('data')); // Create view by name missiontheme/index.blade.php
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        
        MissionTheme::create($request->post());

        return redirect()->route('missiontheme.index')->with('success','Company has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MissionTheme $missionTheme)
    {
        return view('admin.missiontheme.show', compact('missionTheme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MissionTheme $missionTheme)
    {
        return view('admin.missiontheme.edit', compact('missionTheme'));// Create view by name missiontheme/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MissionTheme $missionTheme): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        
        $missionTheme->fill($request->post())->save();

        return redirect()->route('missiontheme.index')->with('success','Company Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MissionTheme $missionTheme): RedirectResponse
    {
        $missionTheme->trashed();
        return redirect()->route('missiontheme.index')->with('success','Company has been deleted successfully');
    }
}
