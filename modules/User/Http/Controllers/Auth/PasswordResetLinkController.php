<?php

namespace User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use User\Models\User;
use User\Notifications\ResetPasswordRequestNotification;
use User\Repositories\UserRepo;
use User\Services\VerifyCodeService;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request views.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('User::forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    public function sendVerifyCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);
        $user = resolve(UserRepo::class)->findByEmail($request->email);
        if ($user && !VerifyCodeService::has($user->id)) {
            $user->sendResetPasswordRequestNotification();
        }

        return view('User::password.verify-code');
    }

    public function checkVerifyCode(Request $request)
    {
        $request->validate([
            'code' => VerifyCodeService::getRule()
        ]);

        $user = resolve(UserRepo::class)->findByEmail($request->email);


        if (!VerifyCodeService::check($user->id, $request->code)) {
            return back()->withErrors(['code' => 'کد وارد شده معتبر نمی باشد']);
        }

        auth()->loginUsingId($user->id);
        return redirect()->route('password.reset');

    }
}
