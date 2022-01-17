<?php

namespace App\Listeners;

use App\Events\NotificationsPushEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationsPushEvent  $event
     * @return void
     */
    public function handle(NotificationsPushEvent $event)
    {
        //
    }
}
