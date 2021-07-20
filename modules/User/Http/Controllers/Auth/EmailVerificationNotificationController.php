<?php

namespace User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use User\Notifications\VerifyEmailNotification;
use User\Services\VerifyCodeService;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => VerifyCodeService::getRule()
        ]);


        if (!VerifyCodeService::check(auth()->user()->id, $request->code)) {
            return back()->withErrors(['code' => 'کد وارد شده معتبر نمی باشد']);
        }

        auth()->user()->markEmailAsVerified();
        return redirect()->route('home');
    }

    public function resend()
    {
        $user = auth()->user();
        $user->notify(new VerifyEmailNotification());
        return back();
    }
}
