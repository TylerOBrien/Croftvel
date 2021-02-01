<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Services\Authenticate;
use App\Http\Controllers\Controller;

class RefreshController extends Controller
{
    /**
     * @return Response
     */
    public function __invoke(Authenticate $authenticator)
    {
        $token = $authenticator->refreshToken();
        $user = auth()->user()
                      ->load(config('croft.relationships.user.show'))
                      ->append(config('croft.attributes.user.show'));

        return array_merge($token, compact('user'));
    }
}
