<?php

namespace App\Http\Controllers\admin;

use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\TimeMission;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
class MissionApplicationController extends AdminBaseController
{
    /**
     * @param Illuminate\Http\Request $request
     *
     * @return string
     */
    public function newMissionApplication(Request $request): string{
        MissionApplication::where('mission_id',$request->mission_id)
                                    ->where('user_id',$request->user_id)
                                    ->firstOrCreate([
                                        'mission_id' => $request->mission_id,
                                        'user_id' => $request->user_id,
                                        'approval_status' => 'PENDING',
                                    ]);
        return "Mission Application Request submitted";
    }

    /**
     * @param Illuminate\Http\Request $request
     *
     * @return string
     */
    public function approveApplication(Request $request): string{
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

    /**
     * @param Illuminate\Http\Request $request
     *
     * @return string
     */
    public function rejectApplication(Request $request): string{
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

    /**
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator{
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
