<?php

namespace App\Query;

use Closure;

class CountryFilter{

    public function handle($request,Closure $next){

        if(!isset(request()->countries)){
            return $next($request);
        }
        $builder = $next($request);
        $country_id_array = explode(',',request()->countries);
        return $builder->whereIn('country_id',$country_id_array);
    }
}



