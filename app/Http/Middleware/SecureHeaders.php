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
        'Permissions-Policy' => 'camera=(), microphone=(), geolocation=(), interest-cohort=()'
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Tạo CSP nonce
        $nonce = $request->session()->token();

        // Thiết lập Content Security Policy với nonce và cho phép cdn.jsdelivr.net
        $cspHeader = "default-src 'self'; " .
                     "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://code.jquery.com; " .
                     "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; " .
                     "img-src 'self' data: https: blob:; " .
                     "font-src 'self' https: data:; " .
                     "connect-src 'self' https://cdn.jsdelivr.net wss: ws:; " .
                     "frame-src 'self'; " .
                     "object-src 'none'; " .
                     "media-src 'self' blob:;";

        $this->secureHeaders['Content-Security-Policy'] = $cspHeader;

        // Áp dụng các header bảo mật cho response
        foreach ($this->secureHeaders as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
