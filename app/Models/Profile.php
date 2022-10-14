<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Profile extends Model
{
    use HasOwnership;

    protected $hidden = [
        'owner_id',
        'owner_type',
    ];

    protected $fillable = [
        'owner_id',
        'owner_type',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany(ProfileField::class);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getValuesAttribute(): Collection
    {
        return $this->fields()->get()->mapWithKeys(function (ProfileField $field) {
            return [ $field->name => $field->value ];
        });
    }
}
