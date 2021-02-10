<?php

namespace App\Http\Requests\Api\v1\ProfileFloatEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileFloatEntry;

class UpdateProfileFloatEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_float_entry';
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
