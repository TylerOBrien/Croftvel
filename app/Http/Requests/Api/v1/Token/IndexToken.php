<?php

namespace App\Http\Requests\Api\v1\Token;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\PersonalAccessToken;

class IndexToken extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
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
            'filter' => 'query_filter:Token'
        ];
    }
}
