<?php

namespace App\Http\Controllers\admin;

use App\Models\MissionTheme;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionThemeRequest;
use App\Http\Requests\UpdateMissionThemeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class MissionThemeController extends AdminBaseController
{
    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View
    {
        return view('admin.missiontheme.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreMissionThemeRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreMissionThemeRequest $request) : RedirectResponse
    {
        MissionTheme::create($request->post());
        return redirect()->route('missiontheme.index')->with('success', 'field has been created successfully.');
    }

    /**
     * Display the specified resource.
     * @param MissionTheme $missionTheme
     *
     * @return View
     */
    public function show(MissionTheme $missiontheme): View
    {
        return view('admin.missiontheme.edit', compact('missiontheme'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param MissionTheme $missionTheme
     *
     * @return View
     */
    public function edit(MissionTheme $missiontheme): View
    {
        return view('admin.missiontheme.edit', compact('missiontheme'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMissionThemeRequest $request
     * @param MissionTheme $missionTheme
     *
     * @return RedirectResponse
     */
    public function update(UpdateMissionThemeRequest $request, MissionTheme $missiontheme) : RedirectResponse
    {
        $missiontheme->fill($request->post())
                    ->save();
        return redirect()->route('missiontheme.index')->with('success', 'field Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param MissionTheme $missionTheme
     *
     * @return RedirectResponse
     */
    public function destroy(MissionTheme $missiontheme) : RedirectResponse
    {
        $missiontheme->delete();
        return back()->with('success', 'field has been deleted successfully');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator
    {
        $request = request();
        return MissionTheme::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('title', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('created_at','desc')
            ->paginate(10);
    }
}
