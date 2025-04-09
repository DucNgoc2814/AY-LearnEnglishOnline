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
        'thanh-toan/*'
    ];
}
