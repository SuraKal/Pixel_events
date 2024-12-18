<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleOrMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // if (Auth::user() && Auth::user()->roles->contains('name', $roles)) {
        //     return $next($request);
        // }

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if the user has any of the specified roles
        foreach ($roles as $role) {
            // Adjust this depending on how you store roles (e.g., column or relationship)
            if ($user->role === $role || ($user->roles && $user->roles->contains('name', $role))) {
                return $next($request);
            }
        }


        abort(403, 'You do not have the required permissions.');
    }
}


