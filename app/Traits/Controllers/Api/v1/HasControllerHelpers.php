<?php

namespace App\Traits\Controllers\Api\v1;

use App\Helpers\Query\QueryFilterHelper;

use Illuminate\Database\Eloquent\Builder;

trait HasControllerHelpers
{
    /**
     * @param  Model  $model
     * @param  string  $resource_name
     * @param  string  $ability_name
     *
     * @return Model
     */
    protected function loaded($model, string $resource_name, string $ability_name = null)
    {
        $relationships_config = "croft.relationships.$resource_name";
        $attributes_config = "croft.relationships.$resource_name";

        if ($ability_name) {
            $relationships_config .= ".$ability_name";
            $attributes_config .= ".$ability_name";
        }

        return $model->load(config($relationships_config))
                     ->append(config($attributes_config));
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  array  $fields
     * @param  string  $resource_name
     * @param  string  $ability_name
     *
     * @return Collection
     */
    protected function filtered(Builder $query, array $fields, string $resource_name = null, string $ability_name = null)
    {
        if (isset($fields['filter'])) {
            $query = QueryFilterHelper::handle($query, $fields['filter']);
        }

        if (is_null($resource_name)) {
            return $query->get();
        }

        $relationships_config = "croft.relationships.$resource_name";
        $attributes_config = "croft.relationships.$resource_name";

        if ($ability_name) {
            $relationships_config .= ".$ability_name";
            $attributes_config .= ".$ability_name";
        }

        return $query->with(config($relationships_config))
                     ->get()
                     ->each->append(config($attributes_config));
    }
}
