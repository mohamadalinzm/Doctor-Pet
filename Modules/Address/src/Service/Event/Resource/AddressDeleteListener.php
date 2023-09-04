<?php

namespace Address\Service\Event\Resource;

use Address\Service\Notification\Resource\AddressDeleteNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AddressDeleteListener implements ShouldQueue
{

    public function handle(AddressDeleted $event)
    {
        Log::info("Address ".$event->address->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AddressDeleteNotification($event->user,$event->address, 'created'));
    }
}
