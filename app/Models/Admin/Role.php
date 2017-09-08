<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\AdminUser[] $users
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $table='admin_roles';
    //
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'admin_permission_role','role_id','permission_id');
    }
    public function users()
    {
        return $this->belongsToMany(AdminUser::class,'admin_role_user','role_id','user_id');
    }
    //给角色添加权限
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }


}
