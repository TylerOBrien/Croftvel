<?php

namespace App\Http\Requests\Api\v1\Image;

use App\Models\Image;
use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexImage extends ApiRequest
{
    use HasRequestHelpers;

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
        return $this->indexRules();
    }
}
