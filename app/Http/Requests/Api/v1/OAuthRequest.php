<?php

namespace App\Http\Requests\Api\v1;

use App\Exceptions\Api\v1\OAuth\ProviderNotFound;
use App\Http\Requests\Api\v1\ApiRequest;

class OAuthRequest extends ApiRequest
{
    /**
     * Create a new request instance.
     *
     * @return void
     */
    public function __construct()
    {
        $given = request()->route('provider');
        $providers = config('enum.oauth.provider', []);

        if (!in_array($given, $providers)) {
            throw new ProviderNotFound;
        }
    }
}
