<?php

namespace App\Traits\Requests\Api\v1;

trait HasOwnership
{
    /**
     * Get the owner_id and owner_type value from the request.
     *
     * @return array
     */
    protected function owner(): array
    {
        if (!$this->has([ 'owner_id', 'owner_type' ])) {
            return [ null, null, null ];
        }

        $owner_id = $this->input('owner_id');
        $owner_type = $this->input('owner_type');

        if (strpos($owner_type, 'App\\Models\\') !== 0) {
            $owner_type = "App\\Models\\$owner_type";
        }

        if (!class_exists($owner_type)) {
            return [ null, null, null ];
        }

        return [ $owner_id, $owner_type, app($owner_type)->getTable() ];
    }
}
