<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'hospital_id',
        'user_id',
        'ambulance_id',
    
    ];


    public function users(){
        return $this->belongsTo(Users::class);
    }

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
