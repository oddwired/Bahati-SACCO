<?php

namespace BahatiSACCO;

use BahatiSACCO\Events\ConductorCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Conductor extends Authenticatable
{
    use Notifiable;

    protected $dispatchesEvents = [
        'created'=> ConductorCreated::class
    ];

    protected $table = "conductors";

    protected $fillable = [
        'first_name', "last_name",'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    //

    function trips(){
        return $this->hasMany(Trip::class, "conductor_id", "id");
    }


}
