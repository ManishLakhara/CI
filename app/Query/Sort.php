<?php

namespace App\Query;

use Closure;

class Sort{

    public function handle($request,Closure $next){

        if(!isset(request()->sort)){
            return $next($request);
        }
        $builder = $next($request);
        switch(request()->sort){
            case '1': // Newest
                $builder = $builder->orderBy('start_date','desc');
                break;
            case '2': // Oldest
                $builder = $builder->orderBy('start_date','asc');
                break;
            case '3': // Lowest Availabel Seat
                $builder = $builder->select('missions.*')
                             ->join('time_missions','time_missions.mission_id','=','missions.mission_id')
                             ->orderBy('time_missions.total_seats', 'asc');
                break;
            case '4': // Highest Availabel Seat
                $builder = $builder->select('missions.*')
                             ->Join('time_missions','time_missions.mission_id','=','missions.mission_id')
                             ->orderBy('time_missions.total_seats', 'desc');
                break;
            case '5': // My Facovorites
                $builder = $builder->select('missions.*')
                             ->leftJoin('favorite_missions','favorite_missions.mission_id','=','missions.mission_id')
                             ->orderBy('favorite_missions.created_at', 'desc');
                break;
            case '6': // Registration DeadLine
                $builder = $builder->select('missions.*')
                             ->leftJoin('time_missions','time_missions.mission_id','=','missions.mission_id')
                             ->orderBy('time_missions.registration_deadline', 'desc');
                break;
        }
        return $builder;
    }
}

