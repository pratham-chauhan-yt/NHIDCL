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
        if (! $request->expectsJson()) {

           // Check which guard was used last time
            if ($request->is('recruitment-portal/*')) {
                return route('recruitment.login');
            }

            // default fallback
            return route('login');
        }

        return null;
    }
}
