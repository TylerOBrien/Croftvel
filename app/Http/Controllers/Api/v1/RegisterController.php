<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\Register;
use App\Models\{ Identity, Secret, User };

class RegisterController extends Controller
{
    /**
     * Create a new account for a guest.
     *
     * @param  \App\Http\Requests\Api\v1\Auth\Register $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Register $request)
    {
        $fields = $request->validated();
        $user = User::createWithAccount();
        $identity = Identity::createFromFields($user, $fields);
        $secret = Secret::createFromFields($user, $fields);

        return compact('user', 'identity', 'secret');
    }
}
