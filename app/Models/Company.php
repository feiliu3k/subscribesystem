<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $primaryKey='id';

    protected $fillable = [
        'companyname'
    ];

    public function managers()
    {
        return $this->belongsToMany(Manager::class);
    }

    public function products()
    {
        return $this->belongsToMany(product::class);
    }
}
