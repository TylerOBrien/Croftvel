<?php

namespace App\Http\Requests\Api\v1\MetaInteger;

use App\Models\MetaInteger;
use App\Http\Requests\Api\v1\ApiRequest;

class IndexMetaInteger extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = MetaInteger::class;
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
