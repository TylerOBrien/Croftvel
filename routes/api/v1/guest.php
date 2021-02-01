<?php

use App\Http\Controllers\Api\v1\Auth\{
    RegisterController,
    LoginController,
    ResetPasswordController,
    ForgotPasswordController };

use Illuminate\Support\Facades\Route;

Route::post('auth/register', RegisterController::class);
Route::post('auth/login', LoginController::class);
Route::post('auth/reset-password', ResetPasswordController::class);
Route::post('auth/forgot-password', ForgotPasswordController::class);
