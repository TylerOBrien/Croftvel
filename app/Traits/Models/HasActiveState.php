<?php

namespace App\Traits\Models;

use Carbon\Carbon;

trait HasActiveState
{
    /**
     * 
     */
    public function activate()
    {
        $this->is_active = 1;
        $this->deleted_by = null;
        $this->deleted_at = null;
        $this->save();
    }

    /**
     * 
     */
    public function deactivate()
    {
        $this->is_active = 0;
        $this->deleted_by = auth()->id();
        $this->deleted_at = Carbon::now(config('app.timezone'));
        $this->save();
    }
}
