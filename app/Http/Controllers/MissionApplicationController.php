<?php

namespace App\Http\Controllers;

use App\Models\MissionApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionApplicationController extends Controller
{
    public function index(Request $request){
        $data = MissionApplication::whereHas('mission', function ($query) use ($request) {
                                            if(($s = $request->s)) {
                                                $query->where('title', 'LIKE', '%'.$s.'%');
                                            }
                                        })
                                           ->orWhereHas('user', function ($query) use ($request) {
                                            if(($s = $request->s)) {
                                                $query->where('first_name','LIKE','%'.$s.'%')
                                                      ->orWhere('last_name', 'LIKE','%'.$s.'%');
                                            }
                                           })
                                           ->orderByRaw("CASE approval_status
                                                WHEN 'PENDING' THEN 1
                                                WHEN 'APPROVE' THEN 2
                                                WHEN 'DECLINE' THEN 3
                                                END")
                                            ->orderBy('created_at', 'desc')
                                            ->paginate(10)
                                            ->appends(['s' => $request->s]);

        return view('admin.missionapplication.index',compact('data'));
    }
    public function newMissionApplication(Request $request){
        $req = MissionApplication::where('mission_id',$request->mission_id)
                                    ->where('user_id',$request->user_id);
        MissionApplication::create($request->post());
        return "Mission Application Request submitted";
    }
    public function approveApplication(Request $request){
        $application = MissionApplication::find($request->mission_application_id);
        $application->approval_status = "APPROVE";
        $application->save();
        return("success");
    }
    public function rejectApplication(Request $request){
        $application = MissionApplication::find($request->mission_application_id);
        $application->approval_status = "DECLINE";
        $application->save();
        return("rejected");
    }
}
