<?php

namespace RolePermissions\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use RolePermissions\Models\Permission;
use User\Models\User;

class RolePermissionsPolisy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function manage(User $user)
    {
        return true;
    }
}
