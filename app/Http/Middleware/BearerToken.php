<?php

namespace App\Http\Middleware;

use Closure;

use App\Exceptions\Api\v1\Auth\InvalidToken;
use App\Guards\Api\v1\ApiGuard;

use Illuminate\Http\Request;

class BearerToken
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
        if (!ApiGuard::get()->parseToken($request)) {
            throw new InvalidToken;
        }

        return $next($request);
    }
}
