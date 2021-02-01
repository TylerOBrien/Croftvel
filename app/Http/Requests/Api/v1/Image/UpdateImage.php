<?php

namespace App\Http\Requests\Api\v1\Image;

use App\Models\Image;
use App\Http\Requests\Api\v1\ApiRequest;

class UpdateImage extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'image';
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
            'image' => 'image',
            'name' => 'string',
            'owner_id' => 'int',
            'owner_type' => 'string'
        ];
    }
}
