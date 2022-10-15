<?php

namespace App\Http\Middleware\Api\v1;

use Closure;

use App\Exceptions\Api\v1\User\UserDisabled;
use App\Guards\Api\v1\ApiGuard;

use Illuminate\Http\Request;

class UserIsEnabled
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

        if (!$user?->is_enabled) {
            throw new UserDisabled;
        }

        return $next($request);
    }
}
