<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleDeviceLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionToken = session('LOGIN_TOKEN');

            if ($user->last_login_token !== $sessionToken) {
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                $loginRoute = match ($user->module_name) {
                    'Recruitment Portal' => 'recruitment.login',
                    'Resource Pool Portal' => 'resource.login',
                    default => 'login', // fallback
                };

                // Optional: flash message
                return redirect()->route($loginRoute)
                    ->withErrors(['error' => 'You have been logged out because your account was accessed from another device.']);
            }
        }

        return $next($request);
    }
}
