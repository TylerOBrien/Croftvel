<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\OAuth\{ ShowProvider, ShowUser };
use App\Http\Resources\Api\v1\{ OAuthProviderResource, OAuthUserResource };

use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * @param  string  $provider
     * @param  \App\Http\Requests\Api\v1\OAuth\ShowUser  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function user(string $provider, ShowUser $request)
    {
        $driver = Socialite::driver($provider)->stateless();
        $user = $driver->user();

        return response()->json(
            new OAuthUserResource($user), 200
        );
    }

    /**
     * @param  string  $provider
     * @param  \App\Http\Requests\Api\v1\OAuth\ShowProvider  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function provider(string $provider, ShowProvider $request)
    {
        $driver = Socialite::driver($provider)->stateless();

        return response()->json(
            new OAuthProviderResource($driver), 200
        );
    }
}
