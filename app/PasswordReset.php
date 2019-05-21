<?php

namespace BahatiSACCO;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = "password_resets";

    protected $fillable = [
        'email', 'role', 'access_hash'
    ];
}
