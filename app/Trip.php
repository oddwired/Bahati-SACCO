<?php

namespace BahatiSACCO;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    protected $table = 'trips';

    protected $fillable = [
        'vehicle_id', 'conductor_id', 'total_amount', 'sacco_charge'
    ];

    function vehicle(){
        return $this->belongsTo(Vehicle::class, "vehicle_id", "id");
    }

    function conductor(){
        return $this->belongsTo(Conductor::class, "conductor_id", "id");
    }
}
