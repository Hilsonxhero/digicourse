<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ConfirmablePasswordController;
use User\Http\Controllers\Auth\AuthenticatedSessionController;
use User\Http\Controllers\Auth\EmailVerificationNotificationController;
use User\Http\Controllers\Auth\EmailVerificationPromptController;
use User\Http\Controllers\Auth\NewPasswordController;
use User\Http\Controllers\Auth\PasswordResetLinkController;
use User\Http\Controllers\Auth\RegisteredUserController;
use User\Http\Controllers\Auth\VerifyEmailController;
use User\Http\Controllers\UserController;

//dashboard
Route::middleware(['web', 'auth', 'verified', 'auth.admin'])->prefix('dashboard')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('users/{user}/add/role', [UserController::class, 'addRole'])->name('users.addRole');
    Route::post('users/{user}/verify/email', [UserController::class, 'verifyUser'])->name('users.verify.email');
    Route::get('user/profile', [UserController::class, 'profile'])->name('dashboard.user.profile');
    Route::post('user/profile', [UserController::class, 'updateProfile'])->name('dashboard.user.profile');
});


Route::middleware('web')
    ->group(function () {

        //register

        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

        //login

        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

        // forgot-password

        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');

        Route::get('/forgot-password/send', [PasswordResetLinkController::class, 'sendVerifyCode'])
            ->middleware('guest')
            ->name('password.sendVerifyCode');

        Route::post('/forgot-password/check-verify-code', [PasswordResetLinkController::class, 'checkVerifyCode'])
            ->middleware(['guest', 'throttle:5,1'])
            ->name('password.checkVerifyCode');

        Route::get('/reset-password/', [NewPasswordController::class, 'create'])
            ->middleware('auth')
            ->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->middleware('auth')
            ->name('password.update');

        Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware('auth')
            ->name('verification.notice');

//        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//            ->middleware(['auth', 'signed', 'throttle:6,1'])
//            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'verify'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');

        Route::post('/email/verification-resend', [EmailVerificationNotificationController::class, 'resend'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.resend');


//        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
//            ->middleware('auth')
//            ->name('password.confirm');
//
//        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
//            ->middleware('auth');

        // logout
        Route::any('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');
    });
