<?php

namespace App\Traits\Models;

trait HasActiveState
{
    /**
     * @return Model
     */
    public function activate()
    {
        $this->is_active = 1;
        
        return $this->save();
    }

    /**
     * @return Model
     */
    public function deactivate()
    {
        $this->is_active = 0;
        
        return $this->save();
    }
}
