<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccess
{
    public function handle(Request $request, Closure $next, $module)
    {
        $user = auth()->user();

        // Allow Super Admin role to bypass
        if ($user && $user->hasRole('Super Admin')) {
            return $next($request);
        }
        // Check if user has any permission in the given module
        if ($user && $user->getAllPermissions()->where('module', $module)->isNotEmpty()) {
            return $next($request);
        }
        abort(403, 'You do not have access to this module.');
    }
}
