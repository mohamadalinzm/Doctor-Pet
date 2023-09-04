<?php

namespace Animal\Service\Event\Resource;

use Animal\Service\Notification\Resource\AnimalCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AnimalCreateListener implements ShouldQueue
{
    public function handle(AnimalCreated $event)
    {
        Log::info("Animal ".$event->Animal->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AnimalCreateNotification($event->user,$event->Animal, 'created'));
    }
}
