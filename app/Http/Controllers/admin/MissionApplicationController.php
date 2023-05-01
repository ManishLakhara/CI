<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\TimeMission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MissionApplicationController extends Controller
{
    public function index(): View
    {
        $data = $this->search();
        $pagination = $data->links()->render();

        if($data instanceof LengthAwarePaginator){
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }
        return view('admin.missionapplication.index',compact('data','pagination'));
    }

    public function newMissionApplication(Request $request){
        MissionApplication::where('mission_id',$request->mission_id)
                                    ->where('user_id',$request->user_id)
                                    ->firstOrCreate([
                                        'mission_id' => $request->mission_id,
                                        'user_id' => $request->user_id,
                                        'approval_status' => 'PENDING',
                                    ]);
        return "Mission Application Request submitted";
    }

    public function approveApplication(Request $request){
        $application = MissionApplication::find($request->mission_application_id);
        $application->approval_status = "APPROVE";
        $application->save();
        $mission = Mission::find($application->mission_id);
        if($mission->timeMission!=null){
            $timeMission = TimeMission::find($mission->timeMission->time_mission_id);
            $timeMission->total_seats = $timeMission->total_seats-1;
            $timeMission->save();
        }
        return("success");
    }
    public function rejectApplication(Request $request){
        $application = MissionApplication::find($request->mission_application_id);
        if($application->approval_status == "APPROVE"){
            $mission = Mission::find($application->mission_id);
            if($mission->timeMission){
                $timeMission = TimeMission::find($mission->timeMission->time_mission_id);
                $timeMission->total_seats = $timeMission->total_seats+1;
                $timeMission->save();
            }
        }
        $application->approval_status = "DECLINE";
        $application->save();
        return("rejected");
    }

    public function search(){
        $request = request();
        return MissionApplication::whereHas('mission', function ($query) use ($request) {
                                    if(($s = $request->s)) {
                                        $query->where('title', 'LIKE', '%'.$s.'%')
                                            ->orWhere('mission_id','LIKE', '%'.$s.'%');
                                    }
                                })
                                ->orWhereHas('user', function ($query) use ($request) {
                                    if(($s = $request->s)) {
                                        $query->where('first_name','LIKE','%'.$s.'%')
                                            ->orWhere('last_name', 'LIKE','%'.$s.'%')
                                            ->orWhere('user_id', 'LIKE','%'.$s.'%');
                                    }
                                })
                                ->orderByRaw("CASE approval_status
                                        WHEN 'PENDING' THEN 1
                                        WHEN 'APPROVE' THEN 2
                                        WHEN 'DECLINE' THEN 3
                                        END")
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);
    }
}
