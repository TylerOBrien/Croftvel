<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::apiResource('addresses', AddressController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('files', FileController::class);
Route::apiResource('identities', IdentityController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('profiles', ProfileController::class);
Route::get('profiles/{profile}/fields', [ ProfileFieldController::class, 'index' ]);
Route::apiResource('profile-fields', ProfileFieldController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('videos', VideoController::class);
