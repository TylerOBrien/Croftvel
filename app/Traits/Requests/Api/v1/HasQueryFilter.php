<?php

namespace App\Traits\Requests\Api\v1;

trait HasQueryFilter
{
    /**
     * Get the store validation rules for an index request.
     *
     * @param  string|null  $model_name_override
     *
     * @return array
     */
    protected function indexRules(string|null $model_name_override = null): array
    {
        return [
            'filter' => 'query_filter:' . ($model_name_override ?? $this->model),
            'sort' => 'query_sorter:' . ($model_name_override ?? $this->model),
            'limit' => 'int|between:1,' . config('queries.max.limit'),
            'offset' => 'int|min:0',
        ];
    }
}
