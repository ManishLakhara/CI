<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\FavoriteMission;
class FavouriteMissionController extends Controller
{
    public function addFavourite(Request $request){
        $fav = FavoriteMission::create($request->post());
        return $fav->favorite_mission_id;
    }
    public function removeFavourite(Request $request){
        $fav = FavoriteMission::where('favorite_mission_id',$request->favorite_mission_id);
        $fav->delete();
        return ;
    }
}
