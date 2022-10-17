<?php

namespace App\Rules;

use ReflectionClass;

use App\Support\Query;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class QueryFilter implements Rule
{
    /**
     * The name of the model to apply the query filter to.
     *
     * @var string
     */
    protected $model_name;

    /**
     * Create a new rule instance.
     *
     * @param  array  $parameters
     *
     * @return void
     */
    public function __construct(array $parameters)
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
    public function passes($attribute, $value): bool
    {
        if (is_null($value)) {
            return true;
        } else if (!is_array($value) || empty($value)) {
            return false;
        }

        $predicate_names = array_flip((new ReflectionClass(Query::class))->getConstants());

        foreach ($value as $column => $predicate) {
            if (!is_string($column) || empty(trim($column)) || (!ctype_alpha($column[0]) && $column[0] !== '_')) {
                return false;
            } else if (!$predicate || !array_intersect_key($predicate, $predicate_names)) {
                return false;
            }
        }

        $model_class_name = Str::start($this->model_name, config('models.namespace'));
        $table_name = app($model_class_name)->getTable();
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
    public function message(): string
    {
        return trans('validation.query-filter');
    }
}
