<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\ResetPassword;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /**
     * Change the user's password and complete the password reset process.
     * 
     * @param ResetPassword $request
     * 
     * @return Response
     */
    public function __invoke(ResetPassword $request)
    {
        $credentials = $request->validated();
        $response = Password::broker()->reset(
            $credentials, function (User $user, $password) {
                $user->password = $password;
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $response === Password::PASSWORD_RESET
            ? $this->successResponse()
            : $this->failureResponse($response);
    }

    /**
     * @return Response
     */
    protected function successResponse()
    {
        return [
            config('croft.responses.key.message') => trans('passwords.reset.succeeded'),
        ];
    }

    /**
     * @return Response
     */
    protected function failureResponse($response)
    {
        $lang = 'passwords.reset.failed';

        switch ($response) {
        case Password::INVALID_TOKEN:
            $lang = 'passwords.reset.invalid-token';
            break;
        case Password::INVALID_USER:
            $lang = 'passwords.reset.invalid-user';
            break;
        }

        return response()->json([
            config('croft.responses.key.message') => trans($lang),
        ], 422);
    }
}
