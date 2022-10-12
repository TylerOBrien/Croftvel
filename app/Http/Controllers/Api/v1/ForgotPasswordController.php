<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\v1\Identity\IdentityNotFound;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\ForgotPassword;
use App\Models\{ Identity, Verification };

class ForgotPasswordController extends Controller
{
    /**
     * Start an account recovery for the given account identity.
     *
     * @param ForgotPassword $request
     *
     * @return Response
     */
    public function __invoke(ForgotPassword $request)
    {
        $fields = $request->validated();
        $identity = Identity::findFromFields($fields);

        if (!$identity) {
            throw new IdentityNotFound;
        }

        return Verification::create([
            'ability' => 'recover',
            'verifiable_id' => $identity->id,
            'verifiable_type' => Identity::class,
        ]);
    }
}
