<?php

namespace App\Http\Requests\Api\v1\Verification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Verification;

class ShowVerification extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'verification';
        $this->model = Verification::class;
    }
}
