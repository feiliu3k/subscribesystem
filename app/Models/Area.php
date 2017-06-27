<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areaname';
    protected $primaryKey='id';

    protected $fillable = [
        'areaname'
    ];

    public function products()
    {
        return $this->belongsToMany(product::class);
    }
}
