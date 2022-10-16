<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\Register;
use App\Http\Resources\Api\v1\PersonalAccessTokenResource;
use App\Models\{ Identity, PersonalAccessToken, Secret, User };

class RegisterController extends Controller
{
    /**
     * Create a new account for a guest.
     *
     * @param  \App\Http\Requests\Api\v1\Auth\Register  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Register $request)
    {
        $fields = $request->validated();
        $user = User::createWithAccount();
        $identity = Identity::createFromFields($user, $fields);
        $pat = PersonalAccessToken::createForIdentity($identity);
        $token = new PersonalAccessTokenResource($pat);

        if ($identity->is_oauth) {
            $secret = Secret::createFromOAuthIdentity($identity);
        } else {
            $secret = Secret::createFromFields($user, $fields);
        }

        return compact('token', 'user', 'identity', 'secret');
    }
}
