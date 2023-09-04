<?php

namespace Address\Service\Event\Resource;

use Address\Service\Notification\Resource\AddressCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AddressCreateListener implements ShouldQueue
{
    public function handle(AddressCreated $event)
    {
        Log::info("Address ".$event->address->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AddressCreateNotification($event->user,$event->address, 'created'));
    }
}
