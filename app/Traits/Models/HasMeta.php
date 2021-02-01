<?php

namespace App\Traits\Models;

use App\Models\Meta;

trait HasMeta
{
    /**
     * 
     */
    public function meta()
    {
        return $this->hasMany(Meta::class, 'owner_id')
                    ->where('owner_type', self::class);
    }
}
