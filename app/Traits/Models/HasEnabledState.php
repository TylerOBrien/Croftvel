<?php

namespace App\Traits\Models;

trait HasEnabledState
{
    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function enable()
    {
        $this->is_enabled = 1;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function disable()
    {
        $this->is_enabled = 0;

        return $this;
    }
}
