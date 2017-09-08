<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin\Role[] $roles
 * @mixin \Eloquent
 */
class Permission extends Model
{
    protected $table='admin_permissions';

    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_permission_role','permission_id','role_id');
    }

}
