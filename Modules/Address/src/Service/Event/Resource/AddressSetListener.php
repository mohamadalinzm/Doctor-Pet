<?php

namespace Address\Service\Event\Resource;

use Address\Service\Notification\Resource\AddressSetAsDefaultNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class AddressSetListener implements ShouldQueue
{
    public function handle(AddressSetDefaultUpdated $event)
    {
        Log::info("Address ".$event->address->id." Created By : ".$event->user->name);
        Notification::send($event->user, new AddressSetAsDefaultNotification($event->user,$event->address, 'created'));
    }
}
