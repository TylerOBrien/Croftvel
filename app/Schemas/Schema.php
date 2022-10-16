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
     * The options value that can be used to change how the rules are generated.
     *
     * @var int
     */
    protected $options;

    /**
     * Instantiates this schema.
     *
     * @param  int  $options  The options value to use.
     *
     * @return void
     */
    public function __construct(int $options = 0)
    {
        $this->attributes = [];
        $this->options = $options;
    }

    /**
     * Runs a Validator instance against the attributes using the rules
     * generated by this schema instance.
     *
     * Will return the valid attributes excluding any attributes not defined in
     * the rules.
     *
     * @param  array<string, mixed>  $attributes  The attributes to validate.
     *
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
     * Generates the rules that will be used for validation. Intended to be
     * overridden by a class extending the base Schema class.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Helper function to quickly run the validator against the given attributes
     * and have only the validated fields returned. Intended to be used if the
     * schema instance only exists to call the validate function.
     *
     * @param  array<string, mixed>  $attributes  The attributes to validate.
     * @param  int  $options  The options value to pass to the schema constructor.
     *
     * @return array<string, mixed>
     */
    static public function validated(array $attributes, int $options = 0): array
    {
        return (new static($options))->validate($attributes);
    }

    /**
     * Generates the rules that will be used if validation is run for the given
     * attribute values.
     *
     * @param  array<string, mixed>  $attributes  The attributes to generate rules for.
     * @param  int  $options  The options value to pass to the schema constructor.
     *
     * @return array<string, string>
     */
    static public function getRules(array $attributes, int $options = 0): array
    {
        $instance = new static($options);
        $instance->attributes = $attributes;

        return $instance->rules();
    }
}
