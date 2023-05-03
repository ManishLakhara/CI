<?php

namespace App\Http\Controllers;

use App\Models\MissionApplication;
use App\Models\MissionRating;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class MissionRatingController extends Controller
{
    /**
     * @param Request $request
     *
     * @return string
     */
    public function addRating(Request $request): string{
        $checkUser = MissionApplication::where('user_id',$request->user_id)
                                        ->where('mission_id',$request->mission_id)
                                        ->first();
        if($checkUser!=Null && $checkUser->approval_status=="APPROVE"){
            $rate = MissionRating::where('user_id','=',$request->user_id)
                            ->where('mission_id','=',$request->mission_id);
            if($rate!=null){
                $rate->delete();
            }
            MissionRating::create($request->post());
            return('Successfully added');
        }
        else{
            return "Sorry you can't Add rating";
        }
    }
}
