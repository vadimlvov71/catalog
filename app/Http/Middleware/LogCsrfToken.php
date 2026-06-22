<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogCsrfToken
{
    public function handle(Request $request, Closure $next)
    {
       /* Log::debug('CSRF Token Debug', [
            'cookie_token' => $request->cookie('XSRF-TOKEN'),
            'header_token' => $request->header('X-CSRF-TOKEN'),
            'input_token' => $request->input('_token'),
            'session_token' => session('_token'),
            'method' => $request->method(),
            'path' => $request->path(),
        ]);*/

        return $next($request);
    }
}