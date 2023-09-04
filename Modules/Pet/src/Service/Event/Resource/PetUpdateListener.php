<?php

namespace Pet\Service\Event\Resource;

use Pet\Service\Notification\Resource\PetUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PetUpdateListener implements ShouldQueue
{
    public function handle(PetUpdated $event)
    {
        Log::info("Pet ".$event->Pet->id." Created By : ".$event->user->name);
        Notification::send($event->user, new PetUpdateNotification($event->user,$event->Pet, 'created'));
    }
}
