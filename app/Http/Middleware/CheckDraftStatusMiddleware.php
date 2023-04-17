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





    public function handle(Request $request, Closure $next)
    {

        $storyId = $request->route('story_id');


        $story = Story::findOrFail($storyId);


        if ($story->status !== 'DRAFT') {

            return response()->json(['error' => 'Only draft stories can be updated.'], 403);
        }


        return $next($request);
    }
}
