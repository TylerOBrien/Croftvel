<?php

namespace App\Traits\Models;

trait HasEnabledState
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function enable()
    {
        $this->is_enabled = 1;
        $this->save();

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function disable()
    {
        $this->is_enabled = 0;
        $this->save();

        return $this;
    }
}
