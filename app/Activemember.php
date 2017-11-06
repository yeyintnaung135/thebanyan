<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Activemember extends Authenticatable
{
    protected $table = 'activemembers';
    protected $fillable = [
        'username', 'hash_psw', 'password',
    ];
}
