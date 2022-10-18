<?php

namespace App\Http\Requests\Api\v1\ProfileField;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileField;
use App\Schemas\Profile\ProfileFieldSchema;

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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return ProfileFieldSchema::getRules($this->all());
    }
}
