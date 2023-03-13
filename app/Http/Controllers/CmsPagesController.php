<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Mission;
use App\Models\MissionTheme;
use App\Models\Skill;
use App\Models\CmsPage;

class CmsPagesController extends Controller
{
    public function index(Request $request)
    {
        $data = CmsPage::orderBy('cms_page_id', 'asc')->paginate(10);

        //$data = MissionTheme::orderBy('mission_theme_id','desc')->paginate(10);
        return view('cms', compact('data')); // Create view by name missiontheme/index.blade.php
    }
}
