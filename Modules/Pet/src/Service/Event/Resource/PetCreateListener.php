<?php

namespace Pet\Service\Event\Resource;

use Pet\Service\Notification\Resource\PetCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PetCreateListener implements ShouldQueue
{
    public function handle(PetCreated $event)
    {
        Log::info("Pet ".$event->Pet->id." Created By : ".$event->user->name);
        Notification::send($event->user, new PetCreateNotification($event->user,$event->Pet, 'created'));
    }
}
