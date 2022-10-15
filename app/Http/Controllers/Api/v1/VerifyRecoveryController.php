<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\v1\Identity\IdentityNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\VerifyRecovery;
use App\Models\Identity;

class VerifyRecoveryController extends Controller
{
    /**
     * Verify the ownership of a recovery attempt.
     *
     * @param  \App\Http\Requests\Api\v1\Auth\VerifyRecovery  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerifyRecovery $request)
    {
        $fields = $request->validated();
        $identity = Identity::findFromFields($fields);

        if (!$identity) {
            throw new IdentityNotFound;
        }

        $identity->verify('recover', $fields); // Will throw error if fails.

        return response(null, 204);
    }
}
