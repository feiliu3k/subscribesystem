<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'Customer';
    protected $primaryKey='id';
   
    protected $fillable = [
        'customeraccount','customername', 'email', 'cellphone', 'IDCard', 'sex', 'credit', 'delflag'
    ];

    protected $hidden =[
        'password', 'remember_token'
    ];
}
