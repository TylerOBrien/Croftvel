<?php

namespace App\Traits\Controllers\Api\v1;

use App\Support\Query;

use Illuminate\Database\Eloquent\{ Builder, Collection };
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasQueryFilter
{
    /**
     * Apply any constraints, if they exist, then execute the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany  $query  The query to apply filter constraints to.
     * @param  array  $fields  The fields containing the raw constraint data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function filtered(Builder|HasMany $query, array $fields): Collection
    {
        if (isset($fields['filter'])) {
            return Query::filter($query, $fields['filter'])->get();
        } else {
            return $query->get();
        }
    }
}
