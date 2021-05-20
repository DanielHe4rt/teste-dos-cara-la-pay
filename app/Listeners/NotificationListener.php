<?php

namespace App\Listeners;

use App\Events\SendNotification;
use App\Services\MockyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener
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
     * @param  \App\Events\SendNotification  $event
     * @return void
     */
    public function handle(SendNotification $event)
    {
        app(MockyService::class)->notifyUser($event->transaction->wallet->user->id);
    }
}
