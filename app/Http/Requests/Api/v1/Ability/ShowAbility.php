<?php

namespace App\Http\Requests\Api\v1\Ability;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Ability;

class ShowAbility extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'ability';
        $this->model = Ability::class;
    }
}
