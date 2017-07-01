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
        return $this->belongsTo(Area::class,'areaname_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class,'producttype_id');
    }

    public function address()
    {
        return $this->hasOne(ProductAddress::class,'productifo_id','id');
    }
}
