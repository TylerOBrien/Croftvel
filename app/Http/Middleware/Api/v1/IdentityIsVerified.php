<?php

namespace App\Http\Middleware\Api\v1;

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
        $user = ApiGuard::get()->user();

        if (!$user || !$user->is_identified) {
            throw new IdentityNotVerified;
        }

        return $next($request);
    }
}
