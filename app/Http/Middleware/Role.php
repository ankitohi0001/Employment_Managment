<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
     public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'admin') {
                // Admin has access to all pages
                return $next($request);
            } elseif ($user->role === 'user') {
                // User only allowed on specific page
                if ($request->is('attendancess')) {
                    return $next($request);
                } else {
                    return redirect('/sign-in')->with('error', 'Unauthorized access.');
                }
            }
        }

        // Redirect to login if user is not authenticated
        return redirect('/sign-in')->with('error', 'Please login to continue.');
    }
}
