<?php

namespace App\Http\Requests\Api\v1\ProfileField;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileField;

class StoreProfileField extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = ProfileField::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'profile_id' => 'required|int|exists:profiles,id',
            'name' => 'required|string',
            'type' => 'required|string|in:' . join(',', config('enum.profile_field.type')),
            'value' => 'required|string',
        ];
    }
}
