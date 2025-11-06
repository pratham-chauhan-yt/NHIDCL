<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureUserExists
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // If logged-in user no longer exists in DB
        if ($user && !User::whereKey($user->id)->exists()) {
            
            $moduleName = $user->module_name;

            // Logout and clear session
            Auth::logout();
            $request->session()->flush();           // clears all session data
            $request->session()->invalidate();      // regenerate session ID
            $request->session()->regenerateToken(); // new CSRF token

            $message = ['login' => 'Your session is invalid. Please log in again.'];

            // Redirect based on module
            return match ($moduleName) {
                'Recruitment Portal' => redirect()->route('recruitment.login')->withErrors($message),
                default              => redirect()->route('auth.login')->withErrors($message),
            };
        }

        return $next($request);
    }
}