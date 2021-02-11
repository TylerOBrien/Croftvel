<?php

namespace App\Http\Requests\Api\v1\File;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\File;
use App\Traits\Requests\Api\v1\HasOwnership;

class StoreFile extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = File::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_id' => 'required|morphable',
            'owner_type' => 'required|morphable',
            'file' => 'required|file',
            'name' => 'required|string'
        ];
    }
}
