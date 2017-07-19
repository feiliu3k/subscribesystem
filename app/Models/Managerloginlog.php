<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Managerloginlog extends Model
{
   protected $table = 'managerloginlog';
    protected $primaryKey='id';
    public $timestamps = false;
   
    protected $fillable = [
        'manager_id','loginaccount', 'successflag', 'ipaddress'
    ];
}
