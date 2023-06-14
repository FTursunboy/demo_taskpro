<?php

namespace App\Notifications\Telegram;

use App\Models\Admin\MessagesModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;


class Chat extends Notification implements ShouldQueue
{
    use Queueable;


    public MessagesModel $message;
    public string $name;
    public $id;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MessagesModel $message, $name, $id)
    {
        $this->message = $message;
        $this->name = $name;
        $this->id = $id;
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

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content("Здравствуйте, {$this->message->sender->name} Отправил вам сообщение
                \n Задача : {$this->name} \t Номер: {$this->id}
                \n Сообщение : {$this->message->message }
                ");

    }
}
