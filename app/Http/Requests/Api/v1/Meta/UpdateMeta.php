<?php

namespace App\Http\Requests\Api\v1\Meta;

use App\Models\Meta;
use App\Http\Requests\Api\v1\ApiRequest;

class UpdateMeta extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'meta';
        $this->model = Meta::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            [
                'name' => 'string'
            ],
            $this->ownershipUpdateRules()
        );
    }
}