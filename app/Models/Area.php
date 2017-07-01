<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areaname';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'areaname', 'delflag'
    ];

    public function products()
    {
        return $this->hasMany(product::class);
    }
}
