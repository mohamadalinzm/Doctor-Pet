<?php

namespace Pet\Service\Event\Resource;

use Pet\Service\Notification\Resource\PetDeleteNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PetDeleteListener implements ShouldQueue
{

    public function handle(PetDeleted $event)
    {
        Log::info("Pet ".$event->Pet->id." Created By : ".$event->user->name);
        Notification::send($event->user, new PetDeleteNotification($event->user,$event->Pet, 'created'));
    }
}
