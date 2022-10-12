<?php

namespace App\Traits\Requests\Api\v1;

trait HasRequestHelpers
{
    /**
     * Get the store validation rules for an index request.
     *
     * @param  string  $model_name_override
     *
     * @return array
     */
    protected function indexRules(string $model_name_override = null): array
    {
        return [
            'filter' => 'query_filter:' . ($model_name_override ?? $this->model),
            'sort' => 'query_sorter:' . ($model_name_override ?? $this->model),
            'limit' => 'int|between:1,' . config('croft.queries.maxLimit'),
            'offset' => 'int|min:0',
        ];
    }
}
