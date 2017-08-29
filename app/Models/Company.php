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
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'usercomment', 'company_id', 'id');
    }
}
