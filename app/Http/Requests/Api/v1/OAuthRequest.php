<?php

namespace App\Http\Requests\Api\v1;

use App\Exceptions\Api\v1\OAuth\{ InvalidCode, ProviderNotFound };
use App\Http\Requests\Api\v1\ApiRequest;
use App\Support\OAuth\OAuthDriver;

use GuzzleHttp\Exception\ClientException;

class OAuthRequest extends ApiRequest
{
    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct()
    {
        $request = request();
        $provider = $request->route('provider') ?? $request->input('identity.provider');

        if ($provider) {
            if (!in_array($provider, config('enum.oauth.provider'))) {
                throw new ProviderNotFound;
            }

            if (request()->has('code')) {
                try {
                    OAuthDriver::get($provider)->stateless()->user();
                } catch (ClientException $exception) {
                    switch ($exception->getResponse()->getStatusCode()) {
                    case 401:
                        throw new InvalidCode;
                    default:
                        throw $exception;
                    }
                }
            }
        }
    }
}
