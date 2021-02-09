<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class ShowIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        var_dump($this->route('identity'));
        die();

        $this->ability = 'show';
        $this->binding = 'identity';
        $this->model = Identity::class;
    }
}
