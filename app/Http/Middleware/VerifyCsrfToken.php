<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'thanh-toan/check-expiry',
        'api/payment/check-expiry',
        'api/*',
        'dang-nhap',
        'dang-ky',
        'thanh-toan/*',
        'test/*/submit',
        'online/login'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($request->route() && $request->route()->named('logout')) {
            // For logout requests, check if we have a saved token in session storage
            $savedToken = $request->header('X-CSRF-TOKEN') ?? $request->input('_token');
            if ($savedToken) {
                $request->session()->put('_token', $savedToken);
            }
        }

        return parent::handle($request, $next);
    }
}
