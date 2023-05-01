<?php

namespace App\Query;

use Closure;

class ThemeFilter{

    public function handle($request,Closure $next){
        if(!isset(request()->themes)){
            return $next($request);
        }
        $builder = $next($request);
        $theme_id_array = explode(',',request()->themes);
        return $builder->whereIn('theme_id',$theme_id_array);
    }
}
