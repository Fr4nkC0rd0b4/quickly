<?php

namespace App\Traits;

use App\Delivery;
use App\Events\NotificationsPushEvent;
use App\Notification;
use App\Notifications\EventNotifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification as Notifications;

trait NotificationTrait
{
    /**
     * Method to send notification via DB and Pusher
     * @param App\Delivery $delivery
     */
    public function sendNotification(Delivery $delivery)
    {
        // Array de datos de notificación
        $data = [
            'title'             => $delivery->user->name,
            'description'         => ' ha aceptado hacer tu entrega.',
            'receipter_id'           => $delivery->user_id,
            'sender_id'       => $delivery->user->id,
            'sender_avatar'     => $delivery->user->avatar
        ];

        // Se envía la notificación vía DB
        Notifications::send($delivery, new EventNotifications($data));

        $created_at = Carbon::now();

        $notification = new Notification();

        $time = $notification->time($created_at);
        $date = $notification->date($created_at);

        // Se arma array para envío notificacion por medio de Pusher
        $notification = [
            'notifiable_id' => $delivery->id,
            'read_at' => null,
            'data' => json_encode($data),
            'created_at' => $created_at,
            'time' => $time,
            'date' => $date,
        ];

        event(new NotificationsPushEvent($notification));
    }
}
