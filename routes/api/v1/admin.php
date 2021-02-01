<?php

use App\Http\Controllers\Api\v1\UserController;

use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class)->except([ 'show', 'update' ]);
Route::post('users/{user}/restore', [ UserController::class, 'restore' ]);
