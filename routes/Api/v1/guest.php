<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;

Route::group(
    [
        'middleware' => [
            StartSession::class, // Sessions required by \Laravel\Socialite\Two\TwitterProvider
        ],
    ],
    function () {
        Route::post('tokens', LoginController::class);
        Route::post('users', RegisterController::class);
        Route::get('oauth/providers', [ OAuthProviderController::class, 'index' ]);
        Route::get('oauth/providers/{provider}', [ OAuthProviderController::class, 'show' ]);
        Route::get('oauth/providers/{provider}/user', [ OAuthProviderController::class, 'user' ]);
    },
);

Route::post('identities/verifications', VerifyIdentityController::class);
Route::post('recoveries', ForgotPasswordController::class);
Route::post('recoveries/verifications', VerifyRecoveryController::class);
