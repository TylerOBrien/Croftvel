<?php

namespace App\Http\Requests\Api\v1\ProfileText;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileText;

class UpdateProfileText extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_text';
        $this->model = ProfileText::class;
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
