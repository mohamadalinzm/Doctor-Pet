<?php

namespace Animal\Service\Event\Resource;

use Animal\Service\Notification\Resource\AnimalDeleteNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AnimalDeleteListener implements ShouldQueue
{

    public function handle(AnimalDeleted $event)
    {
        Log::info("Animal ".$event->Animal->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AnimalDeleteNotification($event->user,$event->Animal, 'created'));
    }
}
