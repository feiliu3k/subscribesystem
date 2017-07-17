<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Authorizable;

    protected $table = 'manager';
    protected $primaryKey='id';
   
    protected $fillable = [
        'manageraccount','managername', 'password', 'email', 'company_id', 'application_note', 'cellphone', 'IDCard', 'sex', 'verifyflag', 'delflag'
    ];

    protected $hidden =[
        'password', 'remember_token'
    ];

    
    public function company()
    {
       return $this->belongsTo(Company::class,'company_id','id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'manager_role','manager_id','role_id');
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
    public function hasPermission($permissionname)
    {   
        $permission=Permission::where('permissionname',$permissionname)
                                ->where('delflag',0)->first();
        if ($permission)
            return $this->hasRole($permission->roles);
        else
            return false;
    }
    // 给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereRolename($role)->firstOrFail()
        );
    }

    public function owns($product) {
        return $this->company_id == $product->company_id;
    }
}
