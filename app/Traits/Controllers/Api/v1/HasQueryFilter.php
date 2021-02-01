<?php

namespace App\Traits\Controllers\Api\v1;

use App\Helpers\QueryFilterHelper;

trait HasQueryFilter
{
    /**
     * 
     */
    protected function filtered($query, array $fields)
    {
        if (isset($fields['filter'])) {
            $query = QueryFilterHelper::handle($query, $fields['filter']);
        }

        return $query;
    }
}
