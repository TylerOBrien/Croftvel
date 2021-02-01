<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Services\Authenticate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\Login;

class LoginController extends Controller
{
    /**
     * Attempt to log the user in.
     * 
     * @param Login $request
     * @param Authenticate $authenticator
     * 
     * @return Response
     */
    public function __invoke(Login $request, Authenticate $authenticator)
    {
        $credentials = $request->validated();
        $token = $authenticator->getToken($credentials);
        $user = auth()->user()
                      ->load(config('croft.relationships.user.show'))
                      ->append(config('croft.attributes.user.show'));

        return array_merge($token, compact('user'));
    }
}
