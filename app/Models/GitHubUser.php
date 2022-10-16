<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GitHubUser extends Model
{
    protected $table = 'github_users';

    protected $fillable = [
        'identity_id',
        'github_id',
        'login',
        'email',
        'avatar_url',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
