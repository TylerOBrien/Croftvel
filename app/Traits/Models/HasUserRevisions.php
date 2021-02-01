<?php

namespace App\Traits\Models;

trait HasUserRevisions
{
    /**
     * 
     */
    public static function boot()
    {
       parent::boot();

       self::creating(function($model) {
           $user_id = auth()->id();
           $model->created_by = $user_id;
       });

       self::updating(function($model) {
           $user_id = auth()->id();
           $model->updated_by = $user_id;
       });
   }
}
