<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Http\Requests\Api\v1\ApiRequest;

class ResendVerificationEmail extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
