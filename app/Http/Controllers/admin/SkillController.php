<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function getAll(){
        $datas = Skill::all();
        return view('admin.missionskill',['data' => $datas]);
    }

    public function new(Request $request){
        $request->validate([
            'skill_name' => 'required',
            'status' => 'required',
        ]);
        $new = new Skill;
        $new->skill_name = $request->skill_name;
        $new->status = $request->status;
        $new->save();
        return back()->with('success','New record have been updated');
    }
}
