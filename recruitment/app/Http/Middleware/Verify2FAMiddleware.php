<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Verify2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        
        if(auth()->check() && !session('two_factor_verified')) {
            return redirect()->route('twoFactor.index'); // Redirect to the two-factor authentication page
        }

        // If the user is authenticated and the two-factor code is verified
        return $next($request);
    }
}
