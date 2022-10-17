<?php

namespace App\Traits\Models;

trait HasFullName
{
    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * @return string|null
     */
    public function getFullNameAttribute(): string|null
    {
        if ($this->first_name) {
            if ($this->last_name) {
                return $this->first_name.' '.$this->last_name;
            } else {
                return $this->first_name;
            }
        }

        return $this->last_name;
    }

    /**
     * @return string|null
     */
    public function getReversedFullNameAttribute(): string|null
    {
        if ($this->last_name) {
            if ($this->first_name) {
                return $this->last_name.', '.$this->first_name;
            } else {
                return $this->last_name;
            }
        }

        return $this->first_name;
    }
}
