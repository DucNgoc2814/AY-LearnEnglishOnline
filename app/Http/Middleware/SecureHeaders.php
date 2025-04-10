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

        // Thiết lập Content Security Policy với các domain cần thiết và chính sách cực kỳ cho phép
        $cspHeader = "default-src * 'self' data: 'unsafe-inline' 'unsafe-eval'; " .
                     "script-src * 'self' data: 'unsafe-inline' 'unsafe-eval'; " .
                     "style-src * 'self' data: 'unsafe-inline'; " .
                     "img-src * 'self' data: blob:; " .
                     "font-src * 'self' data:; " .
                     "connect-src * 'self' data:; " .
                     "frame-src * 'self' data:; " .
                     "object-src 'none';";

        // Re-enable CSP with permissive settings
        $this->secureHeaders['Content-Security-Policy'] = $cspHeader;

        // Áp dụng các header bảo mật cho response
        foreach ($this->secureHeaders as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
