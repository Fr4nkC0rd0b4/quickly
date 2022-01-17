<?php

namespace App\Events;

use App\Notification as NotificationModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationsPushEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        // Get notification from model Notification by ID
        $this->notification = NotificationModel::find($id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['notification-status.' . $this->notification->id, 'notification-status'];
    }

    public function broadcastWith()
    {
        $extra = [
            'status_name' => $this->notification->status
        ];

        // Se agrega el elemento time, que almacena hace cuanto se recibió la notificación
        $this->notification->time = $this->notification->time();

        return array_merge($this->notification->toArray(), $extra);
    }
}
