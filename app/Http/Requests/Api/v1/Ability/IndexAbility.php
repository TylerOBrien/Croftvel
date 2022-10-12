<?php

namespace App\Http\Requests\Api\v1\Ability;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Ability;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexAbility extends ApiRequest
{
    use HasRequestHelpers;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
