<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::apiResource('accounts', AccountController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('files', FileController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('secrets', SecretController::class);
Route::apiResource('tokens', TokenController::class)->except('store');
Route::apiResource('verifications', VerificationController::class);
Route::apiResource('videos', VideoController::class);

Route::apiResource('users', UserController::class)->except('store');
Route::apiResource('users/{user}/secrets', SecretController::class);

Route::put('identities/{identity}/verification', [ IdentityController::class, 'verify' ]);
Route::apiResource('identities', IdentityController::class);

Route::apiResource('metas/{meta}/integers', MetaIntegerController::class);
Route::apiResource('metas/{meta}/strings', MetaStringController::class);
Route::get('metas/{meta}/entries', [ MetaController::class, 'indexEntries' ]);
Route::post('metas/{meta}/entries', [ MetaController::class, 'storeEntries' ]);
Route::apiResource('metas', MetaController::class);

Route::apiResource('profiles/{profile}/floats', ProfileFloatController::class);
Route::apiResource('profiles/{profile}/integers', ProfileIntegerController::class);
Route::apiResource('profiles/{profile}/strings', ProfileStringController::class);
Route::apiResource('profiles/{profile}/texts', ProfileTextController::class);
Route::get('profiles/{profile}/entries', [ ProfileController::class, 'indexEntries' ]);
Route::post('profiles/{profile}/entries', [ ProfileController::class, 'storeEntries' ]);
Route::apiResource('profiles', ProfileController::class);
