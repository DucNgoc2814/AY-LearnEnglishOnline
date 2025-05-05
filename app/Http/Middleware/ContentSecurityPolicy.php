<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " .
            "style-src 'self' 'unsafe-inline'; " .
            "media-src 'self' https://*.oxforddictionaries.com https://*.amazonaws.com; " .
            "img-src 'self' data: https: http:; " .
            "font-src 'self' data:; " .
            "connect-src 'self' https://*.oxforddictionaries.com https://od-api.oxforddictionaries.com"
        );

        return $response;
    }
}
