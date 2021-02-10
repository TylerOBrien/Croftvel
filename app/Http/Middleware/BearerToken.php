<?php

namespace App\Http\Middleware;

use Closure;

use App\Exceptions\Auth\Api\v1\Auth\InvalidToken;

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
        if (!auth()->parseToken($request)) {
            throw new InvalidToken;
        }

        return $next($request);
    }
}
