<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'driver_license',
        'hospital_id'
    ];

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class, 'driver_id');
    }
    public function hospital(){
        return  $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
