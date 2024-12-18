<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Ensure the user is authenticated
        if (!Auth::user()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user has the required role
        
        if (!Auth::user()->roles->contains('name', $role)) {
            abort(403, 'You do not have the required permissions.');
        }


        return $next($request);
    }
}
