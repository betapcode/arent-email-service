<?php


namespace App\Traits;


// use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait
{
    public function roles() {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /*public function permissions() {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }*/

    /*public function rolePermissions() {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }*/

    public function hasRole(...$roles) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    public function checkPermiss($action) {

        $abc = $this->roles()->first();
        $permissions = $abc->permissions;

        if ($permissions) {
            $decoPermissions = json_decode($permissions);
            if (property_exists($decoPermissions, $action)) {
                return (bool) $decoPermissions->$action ?? false;
            }else{
                // \Log::info('khong co gia tri nay: '. $action);
                return false;
            }
        }
        return false;
    }
}
