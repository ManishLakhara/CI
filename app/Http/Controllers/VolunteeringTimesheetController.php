<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSheet;
use App\Models\MissionApplication;
use App\Models\Mission;
use App\Http\Requests\StoreTimeSheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Models\CmsPage;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class VolunteeringTimesheetController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $timesheets = Timesheet::where('user_id', $user->user_id)->get();

        $appliedTimeMissionIds = MissionApplication::where('user_id', $user->user_id)
            ->where('approval_status', 'APPROVE')
            ->pluck('mission_id')
            ->toArray();

        $timemissions = Mission::whereIn('mission_id', $appliedTimeMissionIds)
            ->where('mission_type', 'TIME')
            ->get();

        $missions = Mission::get(['title', 'mission_id']);

        $appliedGoalMissionIds = MissionApplication::where('user_id', $user->user_id)
            ->where('approval_status', 'APPROVE')
            ->pluck('mission_id')
            ->toArray();

        $goalmissions = Mission::whereIn('mission_id', $appliedGoalMissionIds)
            ->where('mission_type', 'GOAL')
            ->get();
        $policies = CmsPage::orderBy('cms_page_id', 'asc')->get();
        return view('volunteeringtimesheet.index', compact('user', 'timesheets', 'appliedTimeMissionIds', 'timemissions', 'appliedGoalMissionIds', 'goalmissions', 'missions','policies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTimesheetRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreTimesheetRequest $request): JsonResponse
    {
        $mission = Mission::findOrFail($request->mission_id);
        $missionType = $mission->mission_type;

        $timesheet = new Timesheet;
        $timesheet->user_id = auth()->user()->user_id;
        $timesheet->mission_id = $request->mission_id;

        if ($missionType == 'TIME') {
            $timesheet->action = null;
            $timesheet->time = sprintf('%02d:%02d:00', $request->hour, $request->minute);
        } else if ($missionType == 'GOAL') {
            $timesheet->time = null;
            $timesheet->action = $request->action;
        }

        $timesheet->date_volunteered = $request->date_volunteered;
        $timesheet->notes = $request->notes;
        $timesheet->status = 'PENDING';
        $timesheet->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update an existing resource in storage.
     * @param UpdateTimesheetRequest $request
     * @param TimeSheet $timesheet
     *
     * @return JsonResponse
     */
    public function update(UpdateTimesheetRequest $request, TimeSheet $timesheet): JsonResponse
    {
        $mission = Mission::findOrFail($request->mission_id);
        $missionType = $mission->mission_type;
        $timesheet->user_id = auth()->user()->user_id;
        $timesheet->mission_id = $request->mission_id;
        if ($missionType == 'TIME') {
            $timesheet->action = null;
            $timesheet->time = sprintf('%02d:%02d:00', $request->hour, $request->minute);
        } else if ($missionType == 'GOAL') {
            $timesheet->time = null;
            $timesheet->action = $request->action;
        }
        $timesheet->date_volunteered = $request->date_volunteered;
        $timesheet->notes = $request->notes;
        $timesheet->status = 'PENDING';
        $timesheet->save();
        return response()->json(['success' => true]);
    }


    /**
     * Remove the specified resource from storage.
     * @param TimeSheet $timesheet
     *
     * @return RedirectResponse
     */
    public function destroy(TimeSheet $timesheet): RedirectResponse
    {
        $timesheet->delete();
        return back()->with('success', 'field has been deleted successfully');
    }
}
