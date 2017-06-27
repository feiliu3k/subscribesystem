<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey='id';

    protected $fillable = [
        'rolename', 'rolelabel', 'description', 'delflag' 
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    //给角色添加权限
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }
}
