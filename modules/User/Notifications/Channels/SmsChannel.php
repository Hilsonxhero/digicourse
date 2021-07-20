<?php


namespace User\Notifications\Channels;


use Illuminate\Notifications\Notification;

class SmsChannel
{

    public function send($notifiable, Notification $notification)
    {
        $data = $notification->ToSms($notifiable);
        $message = $data['text'];
        $receptor = $data['phone'];
        $apiKey = config('services.kavenegar.key');
//        require 'vendor/autoload.php';
        $sender = "1000596446";
        $api = new \Kavenegar\KavenegarApi($apiKey);
        $api->Send($sender, $receptor, $message);

    }

}
