<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MissionTheme;
use Illuminate\Support\Facades\DB;
class MissionThemeController extends Controller
{
    public function getAll(){
        $datas = MissionTheme::all();
        return view('admin.missiontheme',['data' => $datas]);
    }
}
