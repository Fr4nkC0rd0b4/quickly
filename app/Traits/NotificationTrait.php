<?php

namespace App\Traits;

use App\Delivery;
use App\Notifications\EventNotifications;
use Illuminate\Support\Facades\Notification;

trait NotificationTrait
{
    /**
     * Method to send notification via DB and Pusher
     * @param App\Delivery $delivery
     */
    public function sendNotification(Delivery $delivery, $description)
    {
        // Array de datos de notificación
        $data = [
            'title'           => $delivery->user->name,
            'description'     => $description,
            'receipter_id'    => $delivery->user_id,
            'sender_id'       => $delivery->user->id,
            'sender_avatar'   => $delivery->user->avatar
        ];

        // Se envía la notificación vía DB
        Notification::send($delivery, new EventNotifications($data));
    }
}
