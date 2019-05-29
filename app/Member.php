<?php

namespace BahatiSACCO;

use BahatiSACCO\Events\MemberCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;
    //
    protected $dispatchesEvents = [
        'created'=> MemberCreated::class
    ];

    protected $table = "members";

    protected $fillable = [
        'first_name', "last_name", 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    function vehicles(){
        return $this->hasMany(Vehicle::class, "owner_id", "id");
    }

    function loans(){
        return $this->hasMany(Loan::class, "member_id", "id");
    }
}
