<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class LogUserRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            activity()
                ->causedBy(Auth::user()) // Log as the authenticated user
                ->withProperties([
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'route_name' => $request->route()->getName(),
                    'ip_address' => $request->ip(),
                ])
                ->log('User accessed route');
        }
        return $next($request);
    }
}
