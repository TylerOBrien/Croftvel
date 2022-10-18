<?php

namespace App\Http\Requests\Api\v1\ProfileField;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileField;

class UpdateProfileField extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile_field';
        $this->model = ProfileField::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'type' => 'string',
            'value' => 'string',
        ];
    }
}
