<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::apiResource('accounts', AccountController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('files', FileController::class);

Route::put('identities/{identity}/verification', [ IdentityController::class, 'verify' ]);
Route::apiResource('identities', IdentityController::class);

Route::apiResource('images', ImageController::class);
Route::apiResource('metas', MetaController::class);

Route::apiResource('profiles/{profile}/floats', ProfileController::class);
Route::apiResource('profiles/{profile}/integers', ProfileController::class);
Route::apiResource('profiles/{profile}/strings', ProfileController::class);
Route::apiResource('profiles/{profile}/texts', ProfileController::class);
Route::apiResource('profiles', ProfileController::class);

Route::apiResource('secrets', SecretController::class);
Route::apiResource('tokens', TokenController::class)->except('store');
Route::apiResource('users', UserController::class)->except('store');
Route::apiResource('verifications', VerificationController::class);
Route::apiResource('videos', VideoController::class);
