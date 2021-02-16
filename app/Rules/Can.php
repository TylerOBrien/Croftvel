<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Can implements Rule
{
    /**
     * The name of the ability.
     * 
     * @var string
     */
    protected $ability;

    /**
     * The name of the model/policy.
     * 
     * @var string
     */
    protected $target;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $parameters)
    {
        $this->ability = $parameters[0] ?? null;
        $this->target = $parameters[1] ?? null;
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
        $user = auth('croft')->parseToken();

        if (is_null($user)) {
            return false;
        }

        return $user->can(
            $this->ability, app("App\\Models\\{$this->target}")::find($value)
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
