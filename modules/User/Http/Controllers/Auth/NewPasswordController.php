<?php

namespace User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use User\Services\UserService;

class NewPasswordController extends Controller
{

    public function create(Request $request)
    {
        return view('User::reset-password');
    }


    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        UserService::changePassword(auth()->user(), $request->password);
        return redirect()->route('home');
    }
}
