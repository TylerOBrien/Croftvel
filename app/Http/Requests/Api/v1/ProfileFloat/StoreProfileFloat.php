<?php

namespace App\Http\Requests\Api\v1\ProfileFloat;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileFloat;

class StoreProfileFloat extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = ProfileFloat::class;
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
