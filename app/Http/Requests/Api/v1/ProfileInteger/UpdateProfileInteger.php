<?php

namespace App\Http\Requests\Api\v1\ProfileInteger;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileInteger;

class UpdateProfileInteger extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_integer';
        $this->model = ProfileInteger::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_id' => 'int|exists:profiles,id',
            'name' => 'string',
            'value' => 'int'
        ];
    }
}
