<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // If not an admin, redirect to a suitable route (e.g., home or login)
        return redirect('/');
    }
}
