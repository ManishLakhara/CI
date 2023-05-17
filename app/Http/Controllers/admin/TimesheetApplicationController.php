<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeSheet;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Mission;
class TimesheetApplicationController extends Controller
{
    // public function index(Request $request){

    //     $Timesheets = TimeSheet::paginate(3);


    //      if($Timesheets instanceof LengthAwarePaginator){
    //          $pagination = $Timesheets->appends(request()->all())->links('pagination.default');
    //          }

    //      return view('admin.timesheetapplication.index', compact('Timesheets','pagination'));

    // }
    public function index(Request $request) {

        $search = $request->s;
        $Timesheets = TimeSheet::whereHas('mission', function($query) use ($search){
            $query->where('mission_type', 'like', '%'.$search.'%')
                   ->orWhere('title', 'like', '%'.$search.'%');
        })
        ->orWhereHas('user', function($query) use ($search){
            if(($s = $search)) {
            $query->where('first_name', 'like', '%'.$search.'%')
                  ->orWhere('last_name', 'like', '%'.$search.'%')
                  ->orWhere('user_id', 'like','%'.$search.'%');
            }
        })
        ->paginate(10);

        $pagination = $Timesheets->links()->render();
        if ($Timesheets instanceof LengthAwarePaginator) {
            $pagination = $Timesheets->appends(request()->all())->links('pagination.default');
        }

        return view('admin.timesheetapplication.index', compact('Timesheets', 'pagination'));

    }

    public function approveApplication(Request $request){
        $application = Timesheet::find($request->timesheet_id);

        $application->status = "APPROVED";
        $application->save();

        return("success");
    }
    public function rejectApplication(Request $request){
        $application = Timesheet::find($request->timesheet_id);
        $application->status = "DECLINED";
        $application->save();
        return("rejected");
    }
}
