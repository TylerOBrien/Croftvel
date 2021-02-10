<?php

namespace App\Http\Requests\Api\v1\ProfileFloatEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileFloatEntry;

class StoreProfileFloatEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = ProfileFloatEntry::class;
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
