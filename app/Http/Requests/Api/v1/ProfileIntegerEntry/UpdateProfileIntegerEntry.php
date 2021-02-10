<?php

namespace App\Http\Requests\Api\v1\ProfileIntegerEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileIntegerEntry;

class UpdateProfileIntegerEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_integer_entry';
        $this->model = ProfileIntegerEntry::class;
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
