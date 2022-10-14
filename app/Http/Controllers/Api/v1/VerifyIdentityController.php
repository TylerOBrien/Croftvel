<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\v1\Identity\IdentityNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\VerifyIdentity;
use App\Models\Identity;

class VerifyIdentityController extends Controller
{
    /**
     * Verify the ownership of an identity.
     *
     * @param  \App\Http\Requests\Api\v1\Auth\VerifyIdentity $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerifyIdentity $request)
    {
        $fields = $request->validated();
        $identity = Identity::findFromFields($fields);

        if (!$identity) {
            throw new IdentityNotFound;
        }

        $identity->attemptVerify('store', $fields); // Will throw error if fails.

        return response(null, 204);
    }
}
