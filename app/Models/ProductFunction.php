<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFunction extends Model
{
    protected $table = 'productfunction';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'functionname', 'delflag'
    ];

    public function products()
    {
        return $this->belongsToMany(product::class);
    }
}
