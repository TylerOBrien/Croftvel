<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\User;
use App\Http\Requests\Api\v1\ApiRequest;

class IndexUser extends ApiRequest
{
    /**
     * Instantiate the request.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = User::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => 'array'
        ];
    }
}
