<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'ambulance_id',
        'admin_id'

    ];

    public function call()
    {
        return $this->hasMany(Call::class);
    }

    public function ambulance()
    {
        return $this->hasMany(Ambulance::class);
    }



    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
