<?php

namespace App\Traits\Models;

trait HasEnabledState
{
    /**
     * @return Model
     */
    public function enable()
    {
        $this->is_enabled = 1;
        
        return $this->save();
    }

    /**
     * @return Model
     */
    public function disable()
    {
        $this->is_enabled = 0;
        
        return $this->save();
    }
}
