<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use Notifiable;

    protected $table = 'manager';
    protected $primaryKey='id';
   
    protected $fillable = [
        'manageraccount','managername', 'email', 'password', 'company_id', 'application_note', 'cellphone', 'IDCard', 'sex', 'verify', 'delflag'
    ];

    protected $hidden =[
        'password', 'remember_token'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // 判断用户是否具有某个角色
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('rolename', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
    // 判断用户是否具有某权限
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }
    // 给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }
}
