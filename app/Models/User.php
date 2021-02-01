<?php

namespace App\Models;

use App\Notifications\{ PasswordResetRequestNotification, VerifyEmailNotification };
use App\Traits\Models\{ HasActiveState, HasFullName, HasUserRevisions };

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements CanResetPassword, JWTSubject
{
    use Notifiable, HasActiveState, HasFullName, HasUserRevisions;

    protected $appends = [
        'full_name',
        'full_name_reverse'
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'type',
        'status',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * 
     */
    public function email_verification()
    {
        return $this->hasOne(EmailVerification::class);
    }

    /**
     * 
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * 
     */
    public function setRawPasswordAttribute($password)
    {
        $this->attributes['password'] = $password;
    }

    /**
     * 
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetRequestNotification($token));
    }

    /**
     * 
     */
    public function sendEmailVerificationNotification()
    {
        if (!$this->email_verified_at) {
            return $this->notify(new VerifyEmailNotification);
        }
    }
}
