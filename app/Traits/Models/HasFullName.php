<?php

namespace App\Traits\Models;

trait HasFullName
{
    /**
     * 
     */
    public function getFullNameAttribute()
    {
        $full_name = implode(' ', array_filter([ $this->first_name, $this->last_name ]));

        if (empty($full_name)) {
            return null;
        }

        return $full_name;
    }

    /**
     * 
     */
    public function getFullNameReverseAttribute()
    {
        $full_name = implode(', ', array_filter([ $this->last_name, $this->first_name ]));

        if (empty($full_name)) {
            return null;
        }

        return $full_name;
    }
}
