<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'driver_license',
        'ambulance_id'
    ];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }
}
