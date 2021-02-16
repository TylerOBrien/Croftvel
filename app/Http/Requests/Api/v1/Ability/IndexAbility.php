<?php

namespace App\Http\Requests\Api\v1\Ability;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Ability;

class IndexAbility extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Ability::class;
    }
}
