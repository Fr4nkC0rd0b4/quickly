<?php

namespace App\Notifications;

use App\Notification as Noti;
use App\Events\NotificationsPushEvent;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventNotifications extends Notification
{
    use Queueable;

    private $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $data = [
            'title' => $this->notification['title'],
            'description' => $this->notification['description'],
            'receipter_id' => $this->notification['receipter_id'],
            'sender_id' => $this->notification['sender_id'],
            'sender_avatar' => $this->notification['sender_avatar']
        ];

        $created_at = Carbon::now();

        $notification = new Noti();

        $time = $notification->time($created_at);
        $date = $notification->date($created_at);

        // Se arma array para envío notificacion por medio de Pusher
        $notification = [
            'id' => $this->id,
            'notifiable_id' => $notifiable->id,
            'read_at' => null,
            'data' => json_encode($data),
            'created_at' => $created_at,
            'time' => $time,
            'date' => $date,
        ];

        event(new NotificationsPushEvent($notification));

        return $data;
    }
}
