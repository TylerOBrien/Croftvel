<?php

namespace App\Http\Controllers\Api\v1;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\Login;
use App\Http\Resources\Api\v1\PersonalAccessTokenResource;
use App\Models\PersonalAccessToken;

class LoginController extends Controller
{
    /**
     * Attempt to authenticate the guest using the given credentials.
     *
     * @param  \App\Http\Requests\Api\v1\Auth\Login  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Login $request)
    {
        $fields = $request->validated();
        $guard = ApiGuard::get();
        $user = $guard->attempt($fields);
        $pat = PersonalAccessToken::createForUser($user);
        $token = new PersonalAccessTokenResource($pat);
        $identity = $guard->identity();

        return response(compact('token', 'identity', 'user'), 201);
    }
}
