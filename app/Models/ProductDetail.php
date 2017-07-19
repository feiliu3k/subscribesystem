<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'ifodetail';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'usedate', 'usebegintime' ,'useendtime' , 'productprice', 'productnum', 'ordernum', 
        'paynum', 'maxordernum', 'delflag'
    ];

    public function product()
    {
        return $this->belongsTo(product::class,'productifo_id');
    }

    public function buyrecords()
    {
        return $this->hasMany(Buyrecord::class, 'ifodetail_id');
    }

    public function badrecords()
    {
        return $this->hasMany(Badrecord::class, 'ifodetail_id');
    }
}