<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GitHubUser extends Model
{
    protected $table = 'github_users';

    protected $fillable = [
        'user_id',
        'github_id',
        'login',
        'email',
        'avatar_url',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
