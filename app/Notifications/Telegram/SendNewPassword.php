<?php

namespace App\Notifications\Telegram;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class SendNewPassword extends Notification implements ShouldQueue
{
    use Queueable;
    public $id;
    /**
     * Create a new notification instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }


    public function toTelegram()
    {
        $newPass = Str::random(8);
        $user = User::find($this->id);
        $user->password = Hash::make($newPass);
        $user->save();

        return TelegramMessage::create()
            ->content("Ваш новый пароль, $newPass");
    }
}
