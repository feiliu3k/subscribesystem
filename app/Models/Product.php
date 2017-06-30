<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'productifo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'productname', 'productimg' ,'productexplain' ,'delflag'
    ];

    public function area()
    {
        return $this->belongTo(Area::class,'areaname_id');
    }

    public function manager()
    {
        return $this->belongTo(User::class,'manager_id');
    }

    public function company()
    {
        return $this->belongTo(Company::class,'company_id');
    }

    public function productType()
    {
        return $this->belongTo(ProductType::class,'producttype_id');
    }

    public function productAddress()
    {
        return $this->hasOne(ProductAddress::class,'productifo_id');
    }
}
