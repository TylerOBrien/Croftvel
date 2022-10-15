<?php

namespace App\Schemas;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Schema
{
    /**
     * @return array<string, mixed>
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $attributes): array
    {
        $validator = Validator::make($attributes, $this->rules());
        $valid = $validator->validated();

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $valid;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }
}
