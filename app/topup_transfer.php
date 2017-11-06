<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topup_transfer extends Model
{
    //
    protected $table = 'topup_transfer';
    protected $fillable = [
        'member_id', 'phone_no', 'amount','type','date','topup_code'
    ];
    public $timestamps=true;
}
