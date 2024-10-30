<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'hospital_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    // Add any other properties or methods here

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
