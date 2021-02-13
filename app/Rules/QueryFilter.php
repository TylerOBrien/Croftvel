<?php

namespace App\Rules;

use ReflectionClass;

use App\Helpers\QueryFilterHelper;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class QueryFilter implements Rule
{
    /**
     * 
     * 
     * @var string
     */
    protected $model_name;

    /**
     * Create a new rule instance.
     * 
     * @param  Array  $parameters
     *
     * @return void
     */
    public function __construct(Array $parameters)
    {
        $this->model_name = $parameters[0] ?? null;
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
        if (is_null($value)) {
            return true;
        }

        if (!is_array($value) || empty($value)) {
            return false;
        }

        $predicate_names = array_flip((new ReflectionClass(QueryFilterHelper::class))->getConstants());

        foreach ($value as $column => $predicate) {
            if (!is_string($column) || empty(trim($column)) || (!ctype_alpha($column[0]) && $column[0] !== '_')) {
                return false;
            } else if (!$predicate || !array_intersect_key($predicate, $predicate_names)) {
                return false;
            }
        }

        $table_name = app("App\\Models\\{$this->model_name}")->getTable();
        $column_names = Schema::getColumnListing($table_name);

        foreach ($value as $column => $_) {
            if (!in_array($column, $column_names)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.query-filter');
    }
}
