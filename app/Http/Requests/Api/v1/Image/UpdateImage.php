<?php

namespace App\Http\Requests\Api\v1\Image;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Image;
use App\Traits\Requests\Api\v1\HasOwnership;

class UpdateImage extends ApiRequest
{
    use HasOwnership;

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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'owner_id' => 'required_with:owner_type|morphable',
            'owner_type' => 'required_with:owner_id|morphable',
            'image' => 'image',
            'name' => 'string',
        ];
    }
}
