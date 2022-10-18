<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;

class StoreProfile extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Profile::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'fields' => 'array',
            'fields.*.name' => 'required_with:fields|string',
            'fields.*.type' => 'required_with:fields|string|in:' . join(',', config('enum.profile_field.type')),
            'fields.*.value' => 'required_with:fields|string',
        ];
    }
}
