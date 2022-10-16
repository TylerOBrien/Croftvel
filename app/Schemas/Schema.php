<?php

namespace App\Schemas;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Schema
{
    /**
     * The attributes that were just validated against. Will have no value
     * until the validate function is called.
     *
     * @var array<string, mixed>
     */
    protected $attributes;

    /**
     * @return array<string, mixed>
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(array $attributes): array
    {
        $this->attributes = $attributes;

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
