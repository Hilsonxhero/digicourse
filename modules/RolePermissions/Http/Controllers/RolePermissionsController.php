<?php

namespace RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RolePermissions\Repostories\PermissionsRepo;
use RolePermissions\Repostories\RolesRepo;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController extends Controller
{
    public $roleRepo;
    public $permission_repo;

    public function __construct(RolesRepo $rolesRepo, PermissionsRepo $permissionsRepo)
    {
        $this->roleRepo = $rolesRepo;
        $this->permission_repo = $permissionsRepo;
    }

    public function index()
    {

        $roles = $this->roleRepo->all();
        $permissions = $this->permission_repo->all();
        return view('RolePermissions::index', compact('roles', 'permissions'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'unique:roles,name'],
            'permissions' => ['required', 'array', 'min:1']
        ]);

        $this->roleRepo->create($request);
        return redirect()->route('role-permissions.index');


    }

    public function edit($id)
    {
        $role = $this->roleRepo->findById($id);
        $permissions = $this->permission_repo->all();
        return view('RolePermissions::edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', Rule::unique('roles', 'name')->ignore($id)],
            'permissions' => ['required', 'array', 'min:1']
        ]);
        $this->roleRepo->update($id, $request);
        return redirect()->route('role-permissions.index');
    }

    public function destroy($id)
    {
        $this->roleRepo->destroy($id);
        return back();
    }
}
