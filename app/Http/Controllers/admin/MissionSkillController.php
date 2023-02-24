<?php

namespace App\Http\Controllers\admin;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class MissionSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = Skill::orderBy('skill_id','desc')->paginate(10);
        return view('admin.missionskill.index',compact('data')); // Create view by name missionskill/index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return view('admin.missionskill.create'); // Create view by name missionskill/create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'skill_name' => 'required',
            'status' => 'required',
        ]);
        
        MissionTheme::create($request->post());

        return redirect()->route('missionskill.index')->with('success','Company has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill): Response
    {
        return view('admin.missionskill.show', compact('missionTheme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill): Response
    {
        return view('admin.missionskill.edit', compact('skill'));// Create view by name missiontheme/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $request->validate([
            'skill_name' => 'required',
            'status' => 'required',
        ]);
        
        $missionTheme->fill($request->post())->save();

        return redirect()->route('missiontheme.index')->with('success','Company Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        //
    }
}
