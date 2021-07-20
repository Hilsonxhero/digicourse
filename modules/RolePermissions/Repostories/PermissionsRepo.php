<?php


namespace RolePermissions\Repostories;


use Spatie\Permission\Models\Permission;

class PermissionsRepo
{
    public function all()
    {
        return Permission::all();
    }
}
