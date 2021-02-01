<?php

namespace App\Http\Requests\Api\v1\Image;

use App\Models\Image;
use App\Http\Requests\Api\v1\ApiRequest;

class ShowImage extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'image';
        $this->model = Image::class;
    }
}
