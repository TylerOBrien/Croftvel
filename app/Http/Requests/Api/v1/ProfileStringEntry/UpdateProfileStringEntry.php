<?php

namespace App\Http\Requests\Api\v1\ProfileStringEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileStringEntry;

class UpdateProfileStringEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_string_entry';
        $this->model = ProfileStringEntry::class;
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
