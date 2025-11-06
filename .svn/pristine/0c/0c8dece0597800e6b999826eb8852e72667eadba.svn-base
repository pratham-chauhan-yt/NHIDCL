<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSS
{
    // public function handle(Request $request, Closure $next)
    // {
    //     // return $next($request);
    //     if (!$request->isMethod('post')) {
    //         return $next($request);
    //     }

    //     $bypassMimeTypes = [
    //         'application/pdf',
    //         'image/jpeg',
    //         'image/jpg',
    //         'image/png',
    //     ];

    //     foreach ($request->allFiles() as $file) {
    //         if (is_array($file)) {
    //             foreach ($file as $singleFile) {
    //                 if (in_array($singleFile->getMimeType(), $bypassMimeTypes)) {
    //                     return $next($request);
    //                 }
    //             }
    //         } else {
    //             if (in_array($file->getMimeType(), $bypassMimeTypes)) {
    //                 return $next($request);
    //             }
    //         }
    //     }

    //     $input = $request->except($request->files->keys()); // Exclude file inputs from being validated

    //     $invalidCharacters = [];

    //     $patterns = [
    //         '/<\?php/i',
    //         '/script/i',
    //         '/alert/i',
    //         '/prompt/i',
    //         '/onmouseover/i',
    //         '/</',
    //         '/>/',
    //         '/\|/',
    //         '/;/',
    //         '/\$/',
    //         '/%/',
    //         '/\'/',
    //         '/"/',
    //         '/\//',
    //         '/\(/',
    //         '/\)/',
    //         '/\+/',
    //         '/\?/',
    //         '/{/',
    //         '/}/',
    //         '/`/',
    //         '/document/i',
    //         '/window/i',
    //         '/eval/i',
    //         '/fetch/i',
    //         '/base64/i',
    //         '/javascript:/i',
    //         '/vbscript:/i',
    //     ];

    //     // Check for invalid input and sanitize
    //     array_walk_recursive($input, function (&$value) use ($patterns, &$invalidCharacters) {
    //         foreach ($patterns as $pattern) {
    //             if (preg_match($pattern, $value)) {
    //                 $invalidCharacters[] = $value;
    //                 $value = preg_replace($pattern, '', $value); // Remove invalid characters
    //             }
    //         }
    //     });

    //     // If invalid characters are found
    //     if (!empty($invalidCharacters)) {
    //         $invalidCharsString = implode(', ', array_unique($invalidCharacters));
    //         session()->flash('error', "Invalid characters detected: $invalidCharsString. Please remove them and try again.");
    //         return redirect()->to($request->fullUrl())->withInput();
    //     }

    //     // Sanitize remaining input (still excluding files)
    //     array_walk_recursive($input, function (&$value) {
    //         $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    //     });

    //     // Merge the sanitized input back into the request
    //     $request->merge($input);

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        // Only sanitize input for write methods
        if (!in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            return $next($request);
        }

        // Exclude file inputs from being sanitized
        $input = $request->except(array_keys($request->files->all()));

        // Define harmful patterns
        $patterns = [
            // Complete <script> tag
            '/<\s*script[^>]*>.*?<\s*\/\s*script\s*>/is',
            // Common JavaScript attack vectors
            '/alert\s*\(.*?\)/i',
            '/prompt\s*\(.*?\)/i',
            '/confirm\s*\(.*?\)/i',
            '/on\w+\s*=\s*"?.*?"?/i', // onmouseover, onclick etc.
            '/javascript\s*:/i',
            '/vbscript\s*:/i',
            '/eval\s*\(.*?\)/i',
            '/base64\s*,?/i',
            '/document\b/i',
            '/window\b/i',
            '/fetch\s*\(.*?\)/i',
            '/<\?php/i',
        ];
        // Sanitize all string inputs
        array_walk_recursive($input, function (&$value) use ($patterns) {
            if (is_string($value)) {
                foreach ($patterns as $pattern) {
                    $value = preg_replace($pattern, '', $value);
                }

                // Optional: encode remaining HTML special characters
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        });
        // Re-merge sanitized input
        $request->merge($input);
        return $next($request);
    }
}
