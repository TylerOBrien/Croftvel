<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Events\Api\v1\Auth\RegisterEvent;
use App\Models\{ EmailVerification, User };
use App\Services\Authenticate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\Register;

class RegisterController extends Controller
{
    /**
     * Attempt to create a new user account.
     * 
     * @param Register $request
     * @param Authenticate $authenticator
     * 
     * @return Response
     */
    public function __invoke(Register $request, Authenticate $authenticator)
    {
        $fields = $request->validated();

        User::create($fields);

        $token = $authenticator->getToken($fields);
        $user = auth()->user()
                      ->load(config('croft.relationships.user.show'))
                      ->append(config('croft.attributes.user.show'));

        event(new RegisterEvent($user));

        return array_merge($token, compact('user'));
    }
}
