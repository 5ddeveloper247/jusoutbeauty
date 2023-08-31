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
        // '/storeListing',
    	// '/productDetail',
        'Store/*', // Disable CSRF for all routes matching this pattern
        'Products/*', // Disable CSRF for all routes matching this pattern
    ];
}
