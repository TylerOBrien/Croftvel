<?php

namespace App\Helpers;

class QueryFilterHelper
{
    const IS        = 'is';
    const IS_NULL   = 'is_null';
    const ISNT      = 'isnt';
    const ISNT_NULL = 'isnt_null';
    const MIN       = 'min';
    const MAX       = 'max';

    /**
     * 
     */
    public static function handle($query, $filter)
    {
        foreach ($filter as $column => $types) {
            $query = self::processFilter($query, $column, $types);
        }

        return $query;
    }

    /**
     * 
     */
    protected static function processFilter($query, $column, $types)
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
     * 
     */
    protected static function handleIs($query, $column, $value)
    {
        return $query->where($column, '=', $value);
    }

    /**
     * 
     */
    protected static function handleIsnt($query, $column, $value)
    {
        return $query->where($column, '!=', $value);
    }

    /**
     * 
     */
    protected static function handleIsNull($query, $column)
    {
        return $query->whereNull($column);
    }

    /**
     * 
     */
    protected static function handleIsntNull($query, $column)
    {
        return $query->whereNotNull($column);
    }

    /**
     * 
     */
    protected static function handleMin($query, $column, $value)
    {
        return $query->where($column, '>=', $value);
    }

    /**
     * 
     */
    protected static function handleMax($query, $column, $value)
    {
        return $query->where($column, '<=', $value);
    }

    /**
     * 
     */
    protected static function handleBetween($query, $column, $range)
    {
        return $query->whereBetween($column, $range);
    }
}