<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyrecord extends Model
{
    protected $table = 'buyrecord';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'cancelflag', 'buyproductnum', 'buytoken', 'consumptionflag', 'overdueflag'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'productifo_id');
    }

    public function detail()
    {
        return $this->belongsTo(ProductDetail::class,'ifodetail_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
