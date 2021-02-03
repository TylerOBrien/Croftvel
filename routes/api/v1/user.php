<?php

use App\Http\Controllers\Api\v1\{
    AddressController,
    FileController,
    ImageController,
    MetaController,
    MetaIntegerController,
    MetaStringController,
    UserController };

use App\Http\Controllers\Api\v1\Auth\{
    RefreshController,
    EmailVerificationController };

use Illuminate\Support\Facades\Route;

Route::post('refresh', RefreshController::class);

Route::post('auth/email-verification', [ EmailVerificationController::class, 'verify' ]);
Route::post('auth/resend-email-verification', [ EmailVerificationController::class, 'resend' ]);

Route::apiResource('addresses', AddressController::class);
Route::apiResource('files', FileController::class);
Route::apiResource('images', ImageController::class);

Route::apiResource('metas', MetaController::class);
Route::apiResource('metas/{meta}/integers', MetaIntegerController::class);
Route::apiResource('metas/{meta}/strings', MetaStringController::class);

Route::apiResource('users', UserController::class)->except([ 'index', 'store', 'destroy' ]);
