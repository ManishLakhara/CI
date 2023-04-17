<?php

namespace App\Http\Middleware;

use App\Models\Story;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDraftStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */





     public function handle($request, Closure $next)
     {

         $routeName = $request->route()->getName();
         $routeParams = $request->route()->parameters();


         if ($routeName == 'mystories.show' && isset($routeParams['mystory'])) {

             return $next($request);
         }


         $storyId = $request->route('mystory');
         $story = Story::findOrFail($storyId);

         if ($story->status != 'DRAFT') {
             return redirect()->route('mystories.index')->with('error', 'You are not allowed to edit after submit.');
         }

         return $next($request);
     }
}
