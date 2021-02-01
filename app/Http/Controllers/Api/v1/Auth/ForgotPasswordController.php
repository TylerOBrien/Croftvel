<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Models\User;
use App\Events\Api\v1\Auth\{ ForgotPassword as ForgotPasswordEvent, ForgotPasswordFailed };
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\ForgotPassword;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Initiate the password reset process.
     * 
     * @param ForgotPassword $request
     * 
     * @return Response
     */
    public function __invoke(ForgotPassword $request)
    {
        $fields = $request->validated();
        $result = Password::broker()->sendResetLink($fields);
        $user = User::where($fields)
                    ->limit(1)
                    ->first();

        if ($result !== Password::RESET_LINK_SENT) {
            event(new ForgotPasswordFailed($user, $result));
            return $this->failureResponse($result);
        }

        event(new ForgotPasswordEvent($user));
        return $this->successResponse();
    }

    /**
     * @return Response
     */
    protected function successResponse()
    {
        return response()->json([
            config('croft.responses.key.message') => trans('passwords.forgot.succeeded')
        ], 200);
    }

    /**
     * @return Response
     */
    protected function failureResponse($result)
    {
        switch ($result) {
        case PasswordBroker::INVALID_USER:
            $message = trans('passwords.forgot.invalid-user');
            break;
        case PasswordBroker::RESET_THROTTLED:
            $message = trans('passwords.forgot.throttled');
            break;
        default:
            $message = trans('passwords.forgot.failed');
            break;
        }

        return response()->json([
            config('croft.responses.key.message') => $message
        ], 422);
    }
}
