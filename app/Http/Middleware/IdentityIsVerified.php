<?php

namespace App\Http\Middleware;

use Closure;

use App\Exceptions\Api\v1\Identity\IdentityNotVerified;
use App\Guards\Api\v1\ApiGuard;

use Illuminate\Http\Request;

class IdentityIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!ApiGuard::getInstance()->parseToken($request)->is_identified) {
            throw new IdentityNotVerified;
        }

        return $next($request);
    }
}
