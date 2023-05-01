<?php

namespace App\Query;

use Closure;

class SkillFilter{

    public function handle($request,Closure $next){

        if(!isset(request()->skills)){
            return $next($request);
        }
        $builder = $next($request);
        $skill_id_array = explode(',',request()->skills);
        return $builder->select('missions.*')
                               ->join('mission_skills','mission_skills.mission_id','=','missions.mission_id')
                               ->whereIn('mission_skills.skill_id',$skill_id_array)
                               ->distinct();
    }
}
