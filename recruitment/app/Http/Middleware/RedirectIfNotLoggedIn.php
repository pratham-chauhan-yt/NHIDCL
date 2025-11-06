<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfNotLoggedIn
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
        if (!Auth::check()) {
            // Decide where to redirect
            $redirectRoute = $this->getRedirectRoute($request);

            return redirect()->route($redirectRoute)
                ->withErrors(['login' => 'Please log in to continue.']);
        }

        return $next($request);
    }

    /**
     * Determine the correct login route based on request path or module.
     */
    protected function getRedirectRoute(Request $request): string
    {
        // Example: detect module from URL prefix
        if ($request->is('recruitment-portal/*')) {
            return 'recruitment.login';   // named route for recruitment login
        }

        // Default
        return 'auth.login'; // fallback to admin/general login
    }
}

