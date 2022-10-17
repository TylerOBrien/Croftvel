<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Builder;

class Query
{
    const IS        = 'is';
    const ISNT      = 'isnt';
    const IS_NULL   = 'is_null';
    const ISNT_NULL = 'isnt_null';
    const LESS      = 'less';
    const GREATER   = 'greater';
    const MIN       = 'min';
    const MAX       = 'max';

    static protected $constraints = [
        self::IS,
        self::ISNT,
        self::IS_NULL,
        self::ISNT_NULL,
        self::LESS,
        self::GREATER,
        self::MIN,
        self::MAX,
    ];

    /**
     * Apply the given filter to the query builder then return the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  array<string, mixed>  $filter  The column and constraint definitions.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static public function filter(Builder $query, array $filter): Builder
    {
        foreach ($filter as $column => $given_constraints) {
            $query = self::process($query, $column, $given_constraints);
        }

        return $query;
    }

    /**
     * Determine the appropraite constraint to apply to the query based on the
     * given column and constraint values.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  array<string, mixed>  $given_constraints  The names and values of the constraints.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function process(Builder $query, string $column, array $given_constraints): Builder
    {
        $given_constraint_names = array_keys($given_constraints);

        if (empty($given_constraint_names)) {
            return $query;
        }

        $constraints_to_apply = []; // The constraints that will be applied to the query.

        // Before looping over allowed constraints check for both MIN and MAX
        // which implicitly means BETWEEN. If so also remove the MIN and MAX
        // keys so they are not handled a second time in the loop below.

        if (in_array(self::MIN, $given_constraint_names)) {
            if (in_array(self::MAX, $given_constraint_names)) {
                $constraints_to_apply[] = ['between', [ $given_constraints['min'], $given_constraints['max'] ]];
                unset($given_constraint_names[array_search(self::MIN, $given_constraint_names)]);
                unset($given_constraint_names[array_search(self::MAX, $given_constraint_names)]);
            }
        }

        foreach (self::$constraints as $allowed_constraint_name) {
            if (in_array($allowed_constraint_name, $given_constraint_names)) {
                $constraints_to_apply[] = [$allowed_constraint_name, $given_constraints[$allowed_constraint_name]];
            }
        }

        foreach ($constraints_to_apply as [ $name, $value ]) {
            $query = self::$name($query, $column, $value);
        }

        return $query;
    }

    /**
     * Apply the IS constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  mixed  $value  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function is(Builder $query, string $column, $value): Builder
    {
        return $query->where($column, '=', $value);
    }

    /**
     * Apply the ISNT constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  mixed  $value  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function isnt(Builder $query, string $column, $value): Builder
    {
        return $query->where($column, '!=', $value);
    }

    /**
     * Apply the IS_NULL constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function is_null(Builder $query, string $column): Builder
    {
        return $query->whereNull($column);
    }

    /**
     * Apply the LESS constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  mixed  $value  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function less(Builder $query, string $column, $value): Builder
    {
        return $query->where($column, '<', $value);
    }

    /**
     * Apply the GREATER constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  mixed  $value  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function greater(Builder $query, string $column, $value): Builder
    {
        return $query->where($column, '>', $value);
    }

    /**
     * Apply the MIN constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  mixed  $value  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function min(Builder $query, string $column, $value): Builder
    {
        return $query->where($column, '>=', $value);
    }

    /**
     * Apply the MAX constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  mixed  $value  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function max(Builder $query, string $column, $value): Builder
    {
        return $query->where($column, '<=', $value);
    }

    /**
     * Apply the MAX constraint to the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query  The Eloquent query to apply the constraints to.
     * @param  string  $column  The name of the column to constrain.
     * @param  array<mixed>  $range  The value to constrain to.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static protected function between(Builder $query, string $column, array $range): Builder
    {
        return $query->whereBetween($column, $range);
    }
}
