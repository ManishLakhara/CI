<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->guard('admin')->check()) {
            return $next($request);
        }

        return redirect('adminlogin')->with('error', 'You are not authorized to access this page.');
    }
}
