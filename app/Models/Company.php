<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey='id';

    protected $fillable = [
        'companyname'
    ];

    public function managers()
    {
        return $this->hasMany('App\Models\User','company_id','id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','company_id','id');
    }

}
