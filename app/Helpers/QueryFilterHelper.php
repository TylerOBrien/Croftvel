<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryFilterHelper
{
    const IS        = 'is';
    const IS_NULL   = 'is_null';
    const ISNT      = 'isnt';
    const ISNT_NULL = 'isnt_null';
    const MIN       = 'min';
    const MAX       = 'max';

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  Array  $filter
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function handle(Builder $query, Array $filter)
    {
        foreach ($filter as $column => $types) {
            $query = self::processFilter($query, $column, $types);
        }

        return $query;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * @param  Array  $types
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function processFilter(Builder $query, string $column, Array $types)
    {
        $keys = array_keys($types);
        $values = array_values($types);

        $is = in_array(self::IS, $keys);
        $is_null = in_array(self::IS_NULL, $keys);
        $isnt = in_array(self::ISNT, $keys);
        $isnt_null = in_array(self::ISNT_NULL, $keys);
        $min = in_array(self::MIN, $keys);
        $max = in_array(self::MAX, $keys);

        if ($is || $isnt) {
            if ($is) {
                $query = self::handleIs($query, $column, $values);
            } else {
                $query = self::handleIsnt($query, $column, $values);
            }
        } else if ($is_null || $isnt_null) {
            if ($is_null) {
                $query = self::handleIsNull($query, $column);
            } else {
                $query = self::handleIsntNull($query, $column);
            }
        } else {
            if ($min && $max) {
                $query = self::handleBetween($query, $column, $values);
            } else {
                if ($min) {
                    $query = self::handleMin($query, $column, $values[0]);
                } else if ($max) {
                    $query = self::handleMax($query, $column, $values[0]);
                }
            }
        }

        return $query;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * @param  mixed  $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIs(Builder $query, string $column, $value)
    {
        return $query->where($column, '=', $value);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * @param  mixed  $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIsnt(Builder $query, string $column, $value)
    {
        return $query->where($column, '!=', $value);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIsNull(Builder $query, string $column)
    {
        return $query->whereNull($column);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIsntNull(Builder $query, string $column)
    {
        return $query->whereNotNull($column);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * @param  mixed  $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleMin(Builder $query, string $column, $value)
    {
        return $query->where($column, '>=', $value);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * @param  mixed  $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleMax(Builder $query, string $column, $value)
    {
        return $query->where($column, '<=', $value);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string  $column
     * @param  Array  $range
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleBetween(Builder $query, string $column, Array $range)
    {
        return $query->whereBetween($column, $range);
    }
}
