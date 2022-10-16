<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\OAuth\{ ShowOAuthProvider, ShowOAuthUser };
use App\Http\Resources\Api\v1\OAuth\OAuthProviderResource;
use App\Support\OAuth\{ OAuthDriver, OAuthUserEventDispatcher };

class OAuthController extends Controller
{
    /**
     * @param  string  $provider
     * @param  \App\Http\Requests\Api\v1\OAuth\ShowOAuthProvider  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function provider(string $provider, ShowOAuthProvider $request)
    {
        $driver = OAuthDriver::get($provider)->stateless();

        return response(new OAuthProviderResource($driver), 200);
    }

    /**
     * @param  string  $provider
     * @param  \App\Http\Requests\Api\v1\OAuth\ShowOAuthUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function user(string $provider, ShowOAuthUser $request)
    {
        $driver = OAuthDriver::get($provider)->stateless();

        OAuthUserEventDispatcher::dispatch($driver);

        return response($driver->user(), 200);
    }
}
