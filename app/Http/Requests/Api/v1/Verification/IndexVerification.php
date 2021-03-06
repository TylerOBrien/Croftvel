<?php

namespace App\Http\Requests\Api\v1\Verification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Verification;

class IndexVerification extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Verification::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => 'query_filter:Verification'
        ];
    }
}
