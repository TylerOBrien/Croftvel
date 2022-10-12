<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class QuerySorter implements Rule
{
    /**
     * The name of the model to apply the query sorter to.
     *
     * @var string
     */
    protected $model_name;

    /**
     * Create a new rule instance. sort[created_at][desc]
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
    public function passes($attribute, $value)
    {
        if (is_null($value)) {
            return true;
        } else if (!is_array($value) || empty($value)) {
            return false;
        }

        $model_class_name = Str::start($this->model_name, config('croft.models.namespace'));
        $table_name = app($model_class_name)->getTable();
        $column_names = Schema::getColumnListing($table_name);

        foreach ($value as $column => $direction) {
            if (!in_array($column, $column_names) || ($direction !== 'asc' && $direction !== 'desc')) {
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
        return trans('validation.query-sorter');
    }
}
