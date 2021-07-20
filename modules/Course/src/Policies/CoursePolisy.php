<?php

namespace Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use RolePermissions\Models\Permission;
use User\Models\User;

class CoursePolisy
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
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    public function download(User $user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->id === $course->teacher_id ||
            $course->hasStudent($user->id)
        ) return true;
        return false;

    }
}
