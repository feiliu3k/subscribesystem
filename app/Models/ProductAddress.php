<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAddress extends Model
{

    protected $table = 'productaddress';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'productaddress', 'longitude' ,'latitude'
    ];

    public function product()
    {
        return $this->belongTo(Product::class,'productifo_id');
    }
  
}
