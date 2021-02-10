<?php

namespace App\Http\Requests\Api\v1\Secret;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Secret;

class UpdateSecret extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'secret';
        $this->model = Secret::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
