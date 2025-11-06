<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class NoCacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     $response = $next($request);

    //     return $response->withHeaders([
    //         'Cache-Control' => 'no-cache, no-store, must-revalidate',
    //         'Pragma'        => 'no-cache',
    //         'Expires'       => '0',
    //         'X-Frame-Options' => 'DENY',
    //         'X-Content-Type-Options' => 'nosniff',
    //         'Referrer-Policy' => 'no-referrer',
    //     ]);
    // }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof BinaryFileResponse) {
            // Use set() for BinaryFileResponse
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
            $response->headers->set('X-Frame-Options', 'DENY');
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('Referrer-Policy', 'no-referrer');
        } else {
            // Safe for all other response types
            $response->headers->add([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'Pragma'        => 'no-cache',
                'Expires'       => '0',
                'X-Frame-Options' => 'DENY',
                'X-Content-Type-Options' => 'nosniff',
                'Referrer-Policy' => 'no-referrer',
            ]);
        }

        return $response;
    }


}
