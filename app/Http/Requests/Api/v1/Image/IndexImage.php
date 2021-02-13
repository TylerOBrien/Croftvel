<?php

namespace App\Http\Requests\Api\v1\Image;

use App\Models\Image;
use App\Http\Requests\Api\v1\ApiRequest;

class IndexImage extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Image::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => 'query_filter:Image'
        ];
    }
}
