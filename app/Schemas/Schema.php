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

    /**
     * Generates the rules that will be used if validation is run for the given
     * attribute values.
     *
     * @param  array  $attributes  The attributes to generate rules for.
     *
     * @return array<string, mixed>
     */
    static public function getRules(array $attributes): array
    {
        $instance = new static;
        $instance->attributes = $attributes;

        return $instance->rules();
    }
}
