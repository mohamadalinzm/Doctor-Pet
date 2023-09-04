<?php

namespace Animal\Service\Event\Resource;

use Animal\Service\Notification\Resource\AnimalUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AnimalUpdateListener implements ShouldQueue
{
    public function handle(AnimalUpdated $event)
    {
        Log::info("Animal ".$event->Animal->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AnimalUpdateNotification($event->user,$event->Animal, 'created'));
    }
}
