<?php

namespace App\Rules;

use L91\ISO_3166_2\Subdivision;

use Illuminate\Contracts\Validation\Rule;

class Province implements Rule
{
    /**
     * The country code this province is expected to belong to.
     *
     * @var string
     */
    protected $country_code;
    
    /**
     * Create a new rule.
     *
     * @param  array  $parameters
     * 
     * @return bool
     */
    public function __construct(array $parameters)
    {
        $this->country_code = strtoupper($parameters[0] ?? '');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * 
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = strtoupper($value);
        $data = Subdivision::getSubdivisions($this->country_code);

        if (!$subdivisions = get_object_vars($data)) {
            return false;
        }

        return in_array("{$this->country_code}-{$value}", array_keys($subdivisions));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.address.province');
    }
}
