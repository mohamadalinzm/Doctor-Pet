<?php

namespace User\Service\Event\Resource;

use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateListener implements ShouldQueue
{
    public function handle(UserUpdated $event)
    {
        //
    }
}
