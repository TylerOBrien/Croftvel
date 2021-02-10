<?php

namespace App\Traits\Controllers\Api\v1;

use App\Helpers\QueryFilterHelper;

trait HasQueryFilter
{   
    /**
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
     * @return Collection
     */
    protected function filtered($query, array $fields, string $resource_name = null, string $ability_name = null)
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
