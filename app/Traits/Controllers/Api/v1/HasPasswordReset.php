<?php

namespace App\Traits\Controllers\Api\v1;

use App\Models\User;
use App\Events\Api\v1\ForgotPassword;

use Illuminate\Support\Facades\Password;

trait HasPasswordReset
{
    /**
     * 
     */
    protected function sendPasswordResetNotification(User $user, array $fields=null)
    {
        if (!$fields) {
            $fields = [ 'email' => $user->email ];
        }
        
        $response = Password::broker()->sendResetLink($fields);

        if ($response === Password::RESET_LINK_SENT) {
            event(new ForgotPassword($user));
            return $this->successResponse();
        }

        return $this->failureResponse();
    }

    /**
     * 
     */
    protected function successResponse()
    {
        return [
            config('croft.responses.key.message') => trans('passwords.forgot.succeeded')
        ];
    }

    /**
     * 
     */
    protected function failureResponse()
    {
        return [
            config('croft.responses.key.message') => trans('passwords.forgot.failed')
        ];
    }
}
