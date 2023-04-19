<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeSheet;
use App\Models\MissionApplication;
use App\Models\Mission;
use App\Http\Requests\StoreTimeSheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Models\CmsPage;
class VolunteeringTimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $user = Auth::user();

    //     $timesheets = Timesheet::all();

    //     $appliedTimeMissionIds = MissionApplication::where('user_id', $user->user_id)
    //         ->where('approval_status', 'APPROVE')
    //         ->pluck('mission_id')
    //         ->toArray();

    //     $timemissions = Mission::whereIn('mission_id', $appliedTimeMissionIds)->where('mission_type', 'TIME')->get();


    //     $missions = Mission::get(['title', 'mission_id']);
    //     $appliedGoalMissionIds = MissionApplication::where('user_id', $user->user_id)
    //         ->where('approval_status', 'APPROVE')
    //         ->pluck('mission_id')
    //         ->toArray();

    //     $goalmissions = Mission::whereIn('mission_id', $appliedGoalMissionIds)->where('mission_type', 'GOAL')->get();

    //     return view('volunteeringtimesheet.index', compact('user', 'timesheets', 'appliedTimeMissionIds', 'timemissions', 'appliedGoalMissionIds', 'goalmissions', 'missions'));
    // }


    public function index(Request $request)
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimesheetRequest $request)
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


    public function update(UpdateTimesheetRequest $request, $id)
    {

        $timesheet = Timesheet::findOrFail($id);

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
     */
    public function destroy(TimeSheet $sheet, $id)
    {
        $sheet->find($id)->delete();

        return back()->with('success', 'field has been deleted successfully');
    }
}
