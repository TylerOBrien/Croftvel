<?php

namespace App\Traits\Requests\Api\v1;

use Illuminate\Support\Str;

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
        $owner_type = Str::start($this->input('owner_type'), config('models.namespace'));

        if (!class_exists($owner_type)) {
            return [ null, null, null ];
        }

        return [ $owner_id, $owner_type, app($owner_type)->getTable() ];
    }
}
