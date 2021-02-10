<?php

namespace App\Http\Requests\Api\v1\ProfileString;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileString;

class UpdateProfileString extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_string';
        $this->model = ProfileString::class;
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