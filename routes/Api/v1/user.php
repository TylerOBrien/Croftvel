<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::apiResource('accounts', AccountController::class)->except('store');
Route::apiResource('addresses', AddressController::class);
Route::apiResource('files', FileController::class);

Route::put('identities/{identity}/verification', [ IdentityController::class, 'verify' ]);
Route::apiResource('identities', IdentityController::class);

Route::apiResource('images', ImageController::class);

Route::apiResource('metas/{meta}/integers', MetaIntegerController::class);
Route::apiResource('metas/{meta}/strings', MetaStringController::class);
Route::apiResource('metas', MetaController::class);

Route::apiResource('profiles/{profile}/floats', ProfileFloatController::class);
Route::apiResource('profiles/{profile}/integers', ProfileIntegerController::class);
Route::apiResource('profiles/{profile}/strings', ProfileStringController::class);
Route::apiResource('profiles/{profile}/texts', ProfileTextController::class);
Route::apiResource('profiles', ProfileController::class);

Route::apiResource('secrets', SecretController::class);
Route::apiResource('tokens', TokenController::class)->except('store');
Route::apiResource('users', UserController::class)->except('store');
Route::apiResource('verifications', VerificationController::class);
Route::apiResource('videos', VideoController::class);
