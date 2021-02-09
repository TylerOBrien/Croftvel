<?php

use App\Http\Controllers\Api\v1\{ IdentityController, TokenController, UserController, VerificationController };

use Illuminate\Support\Facades\Route;

Route::apiResource('accounts', TokenController::class);
Route::apiResource('addresses', TokenController::class);
Route::apiResource('files', TokenController::class);

Route::put('identities/{identity}/verification', [ IdentityController::class, 'verify' ]);
Route::apiResource('identities', IdentityController::class);

Route::apiResource('images', TokenController::class);
Route::apiResource('metas', TokenController::class);
Route::apiResource('secrets', TokenController::class);
Route::apiResource('tokens', TokenController::class)->except('store');
Route::apiResource('users', UserController::class)->except('store');
Route::apiResource('verifications', VerificationController::class);
Route::apiResource('videos', UserController::class);
