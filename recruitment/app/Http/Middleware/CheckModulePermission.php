<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckModulePermission
{
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();
        if (!$user || $user->hasRole('Super Admin')) {
            return $next($request);
        }
        if (!$user || !$user->can($permission)) {
            abort(403, "You don't have permission to view this page.");
        }
        return $next($request);
    }
}
