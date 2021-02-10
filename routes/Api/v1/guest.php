<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::post('tokens', [ TokenController::class, 'store' ]);
Route::post('users', [ UserController::class, 'store' ]);
