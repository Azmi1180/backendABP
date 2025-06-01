<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'register', // This is the one we're focused on
        'login',
        'logout',
        'articles/*/save',
        'articles/*/unsave',
        // Add any other POST/PUT/DELETE URIs you want to exclude
    ];

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        Log::channel('stderr')->info('CSRF_DEBUG: --- New Request ---'); // To clearly separate requests in log
        Log::channel('stderr')->info('CSRF_DEBUG: Entering inExceptArray method.');
        Log::channel('stderr')->info('CSRF_DEBUG: Request Method: ' . $request->method());
        Log::channel('stderr')->info('CSRF_DEBUG: Request Path: ' . $request->path()); // e.g., 'register'
        Log::channel('stderr')->info('CSRF_DEBUG: Request URI: ' . $request->getRequestUri()); // e.g., '/register'
        Log::channel('stderr')->info('CSRF_DEBUG: Request Full URL: ' . $request->fullUrl());
        Log::channel('stderr')->info('CSRF_DEBUG: Except Array: ' . json_encode($this->except));

        foreach ($this->except as $exceptPattern) {
            // $request->is() handles path matching, including wildcards, and trims slashes.
            // It's the recommended way to check against the $except array patterns.
            Log::channel('stderr')->info('CSRF_DEBUG: Comparing Request Path "' . $request->path() . '" with Except Pattern "' . $exceptPattern . '" using $request->is()');
            if ($request->is($exceptPattern)) {
                Log::channel('stderr')->info('CSRF_DEBUG: MATCHED via $request->is(): Pattern "' . $exceptPattern . '" for path "' . $request->path() . '"');
                return true; // If it matches, it's excepted from CSRF
            }
        }

        Log::channel('stderr')->warning('CSRF_DEBUG: NO MATCH for path: "' . $request->path() . '". CSRF protection will apply.');
        return false; // If no match, CSRF protection applies
    }
}
