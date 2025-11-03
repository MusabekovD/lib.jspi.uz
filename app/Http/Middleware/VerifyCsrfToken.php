<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // '/{token}/webhook',
        // '*/webhook',
        '/admin/upload',

        '/ga3hg123gh12g3hj12g3hj12g3hjg21h33gv31gv3g21v/1316299242:AAGS80Gr9NZ3xJBNhg7FSHla2xTvKPFUNP8/webhook'
    ];
}