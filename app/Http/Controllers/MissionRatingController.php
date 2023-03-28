<?php

namespace App\Http\Controllers;

use App\Models\MissionRating;
use Illuminate\Http\Request;

class MissionRatingController extends Controller
{
    public function addRating(Request $request){
        $rate = MissionRating::where('user_id','=',$request->user_id)
                            ->where('mission_id','=',$request->mission_id);
        if($rate!=null){
            $rate->delete();
        }
        MissionRating::create($request->post());
        return('Successfully added');
    }
}
