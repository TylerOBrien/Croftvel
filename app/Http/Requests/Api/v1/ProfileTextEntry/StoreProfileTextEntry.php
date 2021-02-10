<?php

namespace App\Http\Requests\Api\v1\ProfileTextEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileTextEntry;

class StoreProfileTextEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = ProfileTextEntry::class;
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
