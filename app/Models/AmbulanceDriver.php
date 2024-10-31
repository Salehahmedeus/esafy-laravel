<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbulanceDriver extends Model
{
    protected $fillable = [
        'ambulance_id',
        'driver_id',
    ];

    public function amubulance(){
        return $this->belongsTo(Ambulance::class,'ambulance_id');
    }
    public  function driver(){
        return $this->belongsTo(Driver::class,'driver_id');
    }
}
