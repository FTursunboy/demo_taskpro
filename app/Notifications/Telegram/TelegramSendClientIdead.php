<?php

namespace App\Notifications\Telegram;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramSendClientIdead extends Notification implements ShouldQueue
{
    use Queueable;

    public $name = '';
    public $description = '';

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
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

    public function toTelegram()
    {
        $url = "http://mytask.fingroup.tj";
        return TelegramMessage::create()
            ->content("Здравствуйте, Вам поступила новая системная идея.
                 \n Название : {$this->name}
                 \n Описание : {$this->description}
                ")
            ->button('Перейти', $url);
    }
}
