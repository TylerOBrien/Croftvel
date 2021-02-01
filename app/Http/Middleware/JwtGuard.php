<?php

namespace App\Http\Middleware;

use Closure;

class JwtGuard
{
    /**
     * 
     */
    public function handle($request, Closure $next)
    {
        if (auth()->getDefaultDriver() !== 'jwt') {
            auth()->setDefaultDriver('jwt');
        }

        return $next($request);
    }
}
