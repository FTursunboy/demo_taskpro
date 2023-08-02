<?php

namespace App\Notifications\Telegram;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;


class SendNewPassword extends Notification implements ShouldQueue
{
    use Queueable;

    public int $userID;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ID)
    {
        $this->userID = $ID;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toTelegram($notifiable)
    {
        $newPass = Str::random(8);
        User::where('id', $this->userID)->first()->update([
            'password' => Hash::make($newPass)
        ]);
        return TelegramMessage::create()
            ->content("Здравствуйте, Ваш пароль успешно изменён! \nНовый пароль: $newPass");

    }
}
