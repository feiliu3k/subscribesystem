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
        'customeraccount','customername', 'password', 'email', 'cellphone', 'IDCard', 'sex', 'credit', 'delflag'
    ];

    protected $hidden =[
        'password', 'remember_token'
    ];

    public function buyrecords()
    {
        return $this->hasMany(Customer::class,'customer_id');
    }

    public function badrecords()
    {
        return $this->hasMany(Customer::class,'customer_id');
    }
}
