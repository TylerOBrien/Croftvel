<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::apiResource('addresses', AddressController::class);
Route::apiResource('files', FileController::class);
Route::apiResource('identities', IdentityController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('videos', VideoController::class);
