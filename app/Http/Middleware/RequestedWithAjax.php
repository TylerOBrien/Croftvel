<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class RequestedWithAjax
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');

        return $next($request);
    }
}