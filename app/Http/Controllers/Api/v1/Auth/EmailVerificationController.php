<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Events\Api\v1\Auth\VerifyEmailEvent;
use App\Exceptions\Auth\{ AlreadyVerified, InvalidEmailVerificationCode, MissingVerificationCode };
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\{ ResendVerificationEmail, VerifyEmail };

class EmailVerificationController extends Controller
{
    /**
     * @param VerifyEmail $request
     *
     * @return Response
     */
    public function verify(VerifyEmail $request)
    {
        $fields = $request->validated();
        $user = auth()->user();
        $target_code = $user->email_verification->code ?? null;

        if (intval($fields['code']) !== $target_code) {
            throw new InvalidEmailVerificationCode;
        }

        $user->email_verified_at = now();
        $user->status = 'Ok';
        $user->save();

        event(new VerifyEmailEvent($user));

        return [
            'status' => $user->status,
            'email_verified_at' => $user->email_verified_at
        ];
    }

    /**
     * Redeliver the specified email verification request message.
     * 
     * @param ResendVerificationEmail $request
     * 
     * @return Response
     */
    public function resend(ResendVerificationEmail $request)
    {
        $user = auth()->user();

        if ($user->status !== 'Unverified') {
            throw new AlreadyVerified;
        }

        if (!$user->email_verification) {
            throw new MissingVerificationCode;
        }

        $user->sendEmailVerificationNotification();
    }
}
