<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MissionSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Skill::where([
            ['skill_name', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('skill_name', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(10)
            ->appends(['s' => $request->s]);
        //$data = Skill::orderBy('skill_id','desc')->paginate(10);
        return view("admin.missionskill.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.missionskill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->post());
        return redirect()->route('missionskill.index')->with('success', 'New Record is Updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        return view('admin.missionskill.edit', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill, $id)
    {
        $skill = $skill->find($id);
        return view('admin.missionskill.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill, string $id)
    {
        $request->validated();
        $skill->find($id)
            ->fill($request->post())
            ->save();
        return redirect()->route('missionskill.index')
            ->with('success', 'field Has Been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill, $id)
    {
        $skill->find($id)
            ->delete();
        return back()->with('success', 'Successfully deleted Selected item');
    }
}