<?php

namespace App\Http\Middleware;

use Closure;

class AllowGeolocation
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Allow geolocation for this page
        $response->headers->set('Permissions-Policy', 'geolocation=(self)');

        return $response;
    }
}
