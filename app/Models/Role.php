<?php

namespace App\Models;

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
        return $this->belongsToMany(Permission::class, 'role_permission','role_id', 'permission_id');
    }
    //给角色添加权限
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }

    public function managers()
    {
        return $$this->belongsToMany(User::class, 'manager_role', 'role_id', 'manager_id');
    }
}
