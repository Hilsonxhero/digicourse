<?php


namespace User\Repositories;


use RolePermissions\Models\Permission;
use User\Models\User;

class UserRepo
{

    public function paginate()
    {
        return User::query()->paginate();
    }

    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function create($values)
    {
        $user = User::query()->create([
            'name' => $values->name,
            'email' => $values->email,
            'status' => $values->status,
            'phone' => $values->phone,
            'password' => $values->phone,
            'thumb_id' => $values->thumb_id
        ]);

        return $user->assignRole($values->roles);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function update($values, $user)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'status' => $values->status,
            'phone' => $values->phone,
            'thumb_id' => $values->thumb_id
        ];
        if (!is_null($values->password)) {
            $update['password'] = bcrypt($values->password);
        }
        return $user->syncRoles($values->roles)->update($update);

    }

    public function updateProfile($user, $values)
    {
        $update = [
            'name' => $values->name,
            'email' => $values->email,
            'phone' => $values->phone,
            'thumb_id' => $values->thumb_id
        ];
        if (auth()->user()->email != $values->email) {
            auth()->user()->email = $values->email;
            auth()->user()->email_verified_at = null;
        }
        if (!is_null($values->password)) {
            $update['password'] = bcrypt($values->password);
        }
        return $user->update($update);
    }

    public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }

    public function findFullInfo($user)
    {
        return User::query()->where("id", $user)
            ->with("purchases", "payments", "settlements", "courses")
            ->firstOrFail();
    }

}
