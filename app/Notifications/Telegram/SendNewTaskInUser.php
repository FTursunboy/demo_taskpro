<?php

namespace App\Notifications\Telegram;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class SendNewTaskInUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public int $taskID;
    public string $taskName = '';
    public ?int $taskTime ;
    public string $taskFrom = '';
    public string $taskTo = '';
    public string $finish = '';
    public ?string $tasktype = '';

    public function __construct($id, $name, $time, $from, $to, $finish, $type)
    {
        $this->taskID = $id;
        $this->taskName = $name;
        $this->taskTime = $time;
        $this->taskFrom = date('d-m-Y', strtotime($from));
        $this->finish = date('d-m-Y', strtotime($to));
        $this->taskTo = date('d-m-Y', strtotime($finish));
        $this->tasktype = $type;
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

    public function toTelegram($notifiable)
    {
        $url = "http://fingroup.taskpro.tj/tasks/public/";
        return TelegramMessage::create()
            ->content("Здравствуйте, Вам поступила новая задача.
                \n Номер : {$this->taskID}
                \n Название : {$this->taskName}
                \n Время в часах: {$this->taskTime}
                \n От : {$this->taskFrom}
                \n До : {$this->taskTo }
                \n Дедлайн : {$this->finish }
                \n Тип : {$this->tasktype}
                ")
            ->button('Войти', $url);
    }
}
