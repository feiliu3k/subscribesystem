<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'usercomment';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'company_id', 'productifo_id', 'commentcontent', 'sendtime', 'delflag', 'verifyflag'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productifo_id');
    }
}
