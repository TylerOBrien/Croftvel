<?php

namespace App\Models;

use App\Traits\Models\{ HasAddresses, HasProfiles, HasVariantImages };

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasAddresses, HasVariantImages, HasProfiles;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function location(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->addresses()->whereName(config('models.default.name'))->first(),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function logo(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->imageVariantURLs('logo'),
        );
    }
}
