<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;

use App\Exceptions\Auth\{ ExpiredToken, InvalidToken, MissingToken };

use Tymon\JWTAuth\Exceptions\{ TokenExpiredException, TokenInvalidException };

class JwtAuthenticate
{
    /**
     * 
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $error) {
            if ($error instanceof TokenInvalidException) {
                throw new InvalidToken;
            } else if ($error instanceof TokenExpiredException) {
                throw new ExpiredToken;
            } else {
                throw new MissingToken;
            }
        }

        // Token might be valid, but user row might not
        // exist anymore. Consider that an invalid token.

        if (auth()->user() === NULL) {
            throw new InvalidToken;
        }

        return $next($request);
    }
}
