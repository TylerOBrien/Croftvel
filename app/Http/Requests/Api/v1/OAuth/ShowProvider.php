<?php

namespace App\Http\Requests\Api\v1\OAuth;

use App\Exceptions\Api\v1\OAuth\ProviderNotFound;
use App\Http\Requests\Api\v1\ApiRequest;

class ShowProvider extends ApiRequest
{
    /**
     * Create a new request instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $given = request()->route('provider');
        $providers = config('services', []);

        if (($providers[$given]['type'] ?? null) !== 'oauth') {
            throw new ProviderNotFound;
        }
    }
}
