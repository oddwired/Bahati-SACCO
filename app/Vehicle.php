<?php

namespace BahatiSACCO;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'owner_id', 'registration', 'capacity'
    ];

    function owner(){
        return $this->belongsTo(Member::class, 'owner_id', 'id');
    }

    function trips(){
        return $this->hasMany(Trip::class, "vehicle_id", "id");
    }
}
