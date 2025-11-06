<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockXSSMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Skip XSS check for safe routes (like login)
        $skipRoutes = [
            'login',
            'two-factor',
            'recruitment-portal/login',
            'recruitment-portal/two-factor',
            'recruitment-portal/password/reset',       // base reset page
            'recruitment-portal/password/reset/*',
            'recruitment/password/backend/reset',    // reset page with token
            'recruitment/password/backend/reset/*',
        ];

        foreach ($skipRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        // Only apply for POST requests
        if ($request->isMethod('post')) {
            // Get all input data from the request
            $allInput = $request->all();

            foreach ($allInput as $field => $value) {
                if (is_array($value)) {
                    continue; // skip arrays
                }
                // Only check scalar (non-array) values to avoid false positives
                if (is_string($value) && $this->containsXSS($value)) {
                    $fieldLabel = ucfirst(str_replace('_', ' ', $field));
                    $referer = $request->headers->get('referer') ?? url()->previous();

                    return redirect($referer)
                        ->withInput()
                        ->with('error', "Numeric and special characters should not be allowed.");
                }
            }
        }

        return $next($request);
    }

    protected function containsXSS($value)
    {
        if (is_array($value)) {
            foreach ($value as $item) {
                if ($this->containsXSS($item)) {
                    return true;
                }
            }
        } else {
            $patterns = [
                '/<\s*script\b[^>]*>(.*?)<\s*\/\s*script>/is',   // JS scripts
                '/<\s*(iframe|img|object|embed|svg|form|input|link|style|base)[^>]*?>/i', // Dangerous tags
                '/on\w+\s*=/i',  // Inline JS events
                '/javascript:/i',
                '/data:/i',
                '/vbscript:/i',
                '/<\?php/i',     // PHP opening tag
                '/<\?=/i',       // Shorthand PHP tag
            ];

            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $value)) {
                    return true;
                }
            }
        }

        return false;
    }

}
