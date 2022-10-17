<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GitHubUser extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $table = 'github_users';

    protected $fillable = [
        'github_id',
        'identity_id',
        'email',
        'nickname',
        'profile_image_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
