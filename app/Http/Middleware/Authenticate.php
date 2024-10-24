<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $user = $request->user();

        if ($user === null || !$user->isAdmin()) {
            return route('login');
        }

        return $request->expectsJson() ? null : route('sign-in');
    }
}