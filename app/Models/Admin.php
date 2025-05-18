<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// class Admin extends Model
class Admin extends Authenticatable // must added Authenticatable and remove Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'admin';  // Important for Spatie permission

    protected $fillable = [
        'name',
        'type',
        'phone',
        'email',
        'password',
        'image',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public static function getPermissionGroup()
    {
        $permission_group = Permission::select('group_name as name')
                    ->where('guard_name', 'admin')
                    ->orderBy('group_name')
                    ->groupBy('group_name')  // Group permissions by 'group_name'
                    ->get();
        return $permission_group;
    }

    public static function getPermissionsByGroupName($group_name)
    {
        $permissions = Permission::select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermission($role, $permissions)
    {
        $hasPermission = true;
        // dd($role);
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }
}
