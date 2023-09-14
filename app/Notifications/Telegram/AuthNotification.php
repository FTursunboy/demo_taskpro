<?php

namespace App\Notifications\Telegram;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class AuthNotification extends Notification
{
    use Queueable;
    public string $name = '';
    public string $surname = '';
    /**
     * Create a new notification instance.
     */
    public function __construct($surname, $name)
    {
        $this->name = $name;
        $this->surname = $surname;
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
        $date = Carbon::now()->format('d.m.Y H:i:s');
        return TelegramMessage::create()
            ->content("Добро пожаловать в нашу систему, $this->surname $this->name
            \n Дата входа: $date");
    }
}
