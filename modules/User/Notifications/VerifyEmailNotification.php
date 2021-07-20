<?php

namespace User\Notifications;

use User\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use User\Mail\VerifyCodeMail;
use User\Services\VerifyCodeService;

class VerifyEmailNotification extends Notification
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
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code,now()->addDay());
        return (new VerifyCodeMail($notifiable, $code))->to($notifiable->email)->subject('کد فعال سازی');

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
