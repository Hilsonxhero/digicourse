<?php

namespace User\Notifications;

use User\Mail\ResetPasswordRequestMail;
use User\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use User\Services\VerifyCodeService;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', /*SmsChannel::class*/];
    }


    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code,120);
        return (new ResetPasswordRequestMail($notifiable, $code))->to($notifiable->email)->subject('کد بازیابی رمز عبور');

    }

    public function ToSms($notifiable)
    {

        $code = VerifyCodeService::get($notifiable->id);
        return [
            'text' => " کئ فعال سازی {$code}",
            'phone' => $notifiable->phone
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
