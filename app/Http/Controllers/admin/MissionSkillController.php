<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class MissionSkillController extends AdminBaseController
{
    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('admin.missionskill.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSkillRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreSkillRequest $request): RedirectResponse
    {
        Skill::create($request->post());
        return redirect()->route('skill.index')->with('success', 'New Record is Updated');
    }

    /**
     * Display the specified resource.
     */
    /**
     * @param Skill $skill
     *
     * @return View
     */
    public function show(Skill $skill):  View
    {
        return view('admin.missionskill.edit', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Skill $skill
     *
     * @return View
     */
    public function edit(Skill $skill): View
    {
        return view('admin.missionskill.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSkillRequest $request
     * @param Skill $skill
     *
     * @return RedirectResponse
     */
    public function update(UpdateSkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->fill($request->post())
            ->save();
        return redirect()->route('skill.index')
            ->with('success', 'field Has Been updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param Skill $skill
     *
     * @return RedirectResponse
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();
        return back()->with('success', 'Successfully deleted Selected item');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator{
        $request=request();
        return Skill::where([
                    ['skill_name', '!=', Null],
                    [function ($query) use ($request) {
                        if (($s = $request->s)) {
                            $query->orWhere('skill_name', 'LIKE', '%' . $s . '%')
                                ->get();
                        }
                    }]
                ])->orderBy('created_at','desc')
                    ->paginate(10);
    }
}
