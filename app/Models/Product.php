<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'productifo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'productname', 'productimg' ,'productexplain' ,'delflag', 'cellphone'
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

    public function functions()
    {
        return $this->belongsToMany(ProductFunction::class,'productifo_function','productifo_id','productfunction_id');
    }

    public function details()
    {
        return $this->hasMany(ProductDetail::class, 'productifo_id');
    }

    public function buyrecords()
    {
        return $this->hasMany(Buyrecord::class, 'productifo_id');
    }

    public function badrecords()
    {
        return $this->hasMany(Badrecord::class, 'productifo_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'usercomment', 'productifo_id', 'id');
    }
}
