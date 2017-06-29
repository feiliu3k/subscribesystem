<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';
    protected $primaryKey='id';

    protected $fillable = [
        'permissionname', 'permissionlabel', 'description', 'delflag' 
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
