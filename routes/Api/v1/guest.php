<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::get('oauth/providers/{provider}', [ OAuthController::class, 'provider' ]);
Route::post('recoveries', [ RecoveryController::class, 'store' ]);
Route::post('tokens',  [ TokenController::class, 'store' ]);
Route::post('users', [ UserController::class, 'store' ]);

Route::put('identities/{identity}/recovery', [ IdentityController::class, 'recover' ]);
