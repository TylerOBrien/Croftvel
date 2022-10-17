<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\OAuth\{ IndexOAuthProvider, ShowOAuthProvider, ShowOAuthUser };
use App\Http\Resources\Api\v1\OAuth\OAuthProviderResource;
use App\Support\OAuth\{ OAuthDriver, OAuthProvider };

class OAuthProviderController extends Controller
{
    /**
     * Respond with a listing of OAuth providers.
     *
     * @param  \App\Http\Requests\Api\v1\OAuth\IndexOAuthProvider  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexOAuthProvider $request)
    {
        return response(OAuthProvider::all(), 200);
    }

    /**
     * Respond with a single OAuth provider resource.
     *
     * @param  string  $provider
     * @param  \App\Http\Requests\Api\v1\OAuth\ShowOAuthProvider  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $provider, ShowOAuthProvider $request)
    {
        $driver = OAuthDriver::get($provider)->stateless();
        $resource = new OAuthProviderResource($driver);

        return response($resource, 200);
    }

    /**
     * @param  string  $provider
     * @param  \App\Http\Requests\Api\v1\OAuth\ShowOAuthUser  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function user(string $provider, ShowOAuthUser $request)
    {
        $out = [
            'session' => session()->all(),
            'request' => request()->all(),
        ];

        session()->flush();

        return response($out, 200);
    }
}
