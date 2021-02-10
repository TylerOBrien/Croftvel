<?php

namespace App\Http\Requests\Api\v1\Token;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\PersonalAccessToken;

class UpdateToken extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'token';
        $this->model = PersonalAccessToken::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tokenable_id' => 'required_with:tokenable_type|int',
            'tokenable_type' => 'required_with:tokenable_id|string',
            'name' => 'string',
            'abilities' => 'array'
        ];
    }
}
