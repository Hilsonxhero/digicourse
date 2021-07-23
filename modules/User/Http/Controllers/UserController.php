<?php

namespace User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Media\Services\MediaFileService;
use RolePermissions\Repostories\RolesRepo;
use User\Http\Requests\UpdateProfileRequest;
use User\Http\Requests\UserCreateRequest;
use User\Http\Requests\UserUpdateRequest;
use User\Models\User;
use User\Repositories\UserRepo;

class UserController extends Controller
{
    public $UserRepo;
    public $RoleRepo;

    public function __construct(UserRepo $userRepo, RolesRepo $rolesRepo)
    {
        $this->UserRepo = $userRepo;
        $this->RoleRepo = $rolesRepo;
    }

    public function index()
    {
        $roles = $this->RoleRepo->all();
        $users = $this->UserRepo->paginate();
        return view('User::panel.index', compact('users', 'roles'));
    }

    public function addRole()
    {

    }

    public function create()
    {
        //
    }

    public function store(UserCreateRequest $request)
    {
        $request->request->add(['thumb_id' => MediaFileService::publicUpload($request->file('thumb'))->id]);
        $this->UserRepo->create($request);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = $this->UserRepo->findById($id);
        $roles = $this->RoleRepo->all();
        return view('User::panel.edit', compact('user', 'roles'));
    }


    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->UserRepo->findById($id);
        if ($request->hasFile('thumb')) {
            $request->request->add(['thumb_id' => MediaFileService::publicUpload($request->file('thumb'))->id]);
            $user->thumb ? $user->thumb->delete() : "";
        } else {
            $request->request->add(['thumb_id' => $user->thumb_id]);
        }
        $this->UserRepo->update($request, $user);
        newFeedback("موفقیت آمیز", "نقش کاربری مورد نظر به کاربر {$user->name} داده شد", 'success');
        return redirect()->route('users.index');
    }

    public function verifyUser($id)
    {
        $user = $this->UserRepo->findById($id);

        $user->markEmailAsVerified();
        return redirect()->route('users.index');
    }

    public function profile()
    {
        return view('User::panel.profile');
    }

    public function info(User $user)
    {

        $user = $this->UserRepo->findFullInfo($user->id);
        return view('User::panel.user-info', compact('user'));
    }


    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        if ($request->hasFile('thumb')) {
            $request->request->add(['thumb_id' => MediaFileService::publicUpload($request->file('thumb'))->id]);
            $user->thumb ? $user->thumb->delete() : "";

        } else {
            $request->request->add(['thumb_id' => $user->thumb_id]);
        }
        $this->UserRepo->updateProfile($user, $request);
        return back();
    }

    public function destroy($id)
    {
        $user = $this->UserRepo->findById($id);
        $user->delete();
        return back();
    }
}
