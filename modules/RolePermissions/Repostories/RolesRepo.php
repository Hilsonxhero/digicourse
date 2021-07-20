<?php


namespace RolePermissions\Repostories;


use Spatie\Permission\Models\Role;

class RolesRepo
{
    public function all()
    {
        return Role::all();
    }

    public function create($values)
    {
        return Role::query()->create(['name' => $values->name])->syncPermissions($values->permissions);
    }

    public function findById($id)
    {
        return Role::query()->findOrFail($id);
    }

    public function update($id, $values)
    {
        $role = $this->findById($id);
        return $role->syncPermissions($values->permissions)->update(['name' => $values->name]);
    }

    public function destroy($id)
    {
        $role = $this->findById($id);
        $role->delete();
    }

}
