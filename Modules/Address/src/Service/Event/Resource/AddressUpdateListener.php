<?php

namespace Address\Service\Event\Resource;

use Address\Service\Notification\Resource\AddressUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AddressUpdateListener implements ShouldQueue
{
    public function handle(AddressUpdated $event)
    {
        Log::info("Address ".$event->address->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AddressUpdateNotification($event->user,$event->address, 'created'));
    }
}
