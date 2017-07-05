<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badrecord extends Model
{
    protected $table = 'badrecord';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'cancelflag', 'buyproductnum', 'buytoken', 'consumptionflag', 'overdueflag'
    ];

    public function company()
    {
        return $this->belongsTo(company::class,'company','company_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'productifo','productifo_id');
    }

    public function detail()
    {
        return $this->belongsTo(ProductDetail::class,'ifodetail','ifodetail_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer','customer_id');
    }
}