<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'producttype';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'typename', 'delflag'
    ];

    public function products()
    {
        return $this->belongsToMany(product::class);
    }
}
