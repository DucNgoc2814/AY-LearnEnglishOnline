<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    /**
     * Headers bảo mật được áp dụng cho tất cả các response
     *
     * @var array
     */
    private $secureHeaders = [
        'X-XSS-Protection' => '1; mode=block',
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'SAMEORIGIN',
        'Referrer-Policy' => 'same-origin',
        'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
        'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()'
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Thiết lập Content Security Policy với các domain cần thiết
        $cspHeader = "default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: *; " .
                     "script-src 'self' 'unsafe-inline' 'unsafe-eval' data: *; " .
                     "style-src 'self' 'unsafe-inline' data: *; " .
                     "img-src 'self' data: blob: *; " .
                     "font-src 'self' data: *; " .
                     "connect-src 'self' *; " .
                     "media-src 'self' *; " .
                     "object-src 'none'";

        $this->secureHeaders['Content-Security-Policy'] = $cspHeader;

        // Áp dụng các header bảo mật cho response
        foreach ($this->secureHeaders as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
