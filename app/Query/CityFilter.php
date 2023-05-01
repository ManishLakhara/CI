<?php

namespace App\Query;

use Closure;

class CityFilter{

    public function handle($request,Closure $next){

        if(!isset(request()->cities)){
            return $next($request);
        }
        $builder = $next($request);
        $city_id_array = explode(',',request()->cities);
        return $builder->whereIn('city_id',$city_id_array);
    }
}

