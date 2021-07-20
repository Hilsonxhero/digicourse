<?php

namespace Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use RolePermissions\Models\Permission;
use User\Models\User;

class LessonPolisy
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

    public function download(User $user,$lesson)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $user->id === $lesson->course->teacher_id ||
            $lesson->course->hasStudent($user->id) ||
            $lesson->free
        ) return true;
        return false;

    }
}
