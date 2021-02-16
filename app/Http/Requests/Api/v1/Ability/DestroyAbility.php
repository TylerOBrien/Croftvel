<?php

namespace App\Http\Requests\Api\v1\Ability;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Ability;

class DestroyAbility extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'ability';
        $this->model = Ability::class;
    }
}
