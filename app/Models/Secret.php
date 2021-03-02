<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{ Crypt, Hash };

class Secret extends Model
{
    protected $hidden = [
        'value'
    ];

    protected $fillable = [
        'user_id',
        'type',
        'value'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Register creating handler to ensure secret is not stored in plaintext.
     * 
     * @return void
     */
    static public function boot()
    {
        parent::boot();
        self::creating(function($model) {
            switch ($model->type) {
            case 'password':
                $model->value = Hash::make($model->value);
                break;
            case 'totp':
                $model->value = Crypt::encryptString($model->value);
                break;
            }
        });
    }
}
