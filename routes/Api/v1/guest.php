<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::get('oauth/providers/{provider}', [ OAuthController::class, 'provider' ]);
Route::get('oauth/providers/{provider}/user', [ OAuthController::class, 'user' ]);

Route::post('identities/verifications', VerifyIdentityController::class);
Route::post('recoveries', ForgotPasswordController::class);
Route::post('recoveries/verifications', VerifyRecoveryController::class);
Route::post('tokens', LoginController::class);
Route::post('users', RegisterController::class);
