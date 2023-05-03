<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\FavoriteMission;
class FavouriteMissionController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     */
    public function addFavourite(Request $request): int{
        $fav = FavoriteMission::create($request->post());
        return $fav->favorite_mission_id;
    }

    /**
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function removeFavourite(Request $request): void{
        $fav = FavoriteMission::where('favorite_mission_id',$request->favorite_mission_id);
        $fav->delete();
    }
}
