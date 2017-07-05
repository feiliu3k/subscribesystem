<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customerloginlog extends Model
{
   protected $table = 'customerloginlog';
    protected $primaryKey='id';
    public $timestamps = false;
   
    protected $fillable = [
        'customer_id','loginaccount', 'successflag', 'ipaddress'
    ];
}
