<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $fillable = [
        'license_number',
        'status',
        'latitude',
        'longitude',
        'hospital_id',

    ];

    public function call()
    {
        return $this->hasMany(Call::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
