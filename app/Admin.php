<?php

namespace BahatiSACCO;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admins";
    protected $fillable = [
        'username', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
