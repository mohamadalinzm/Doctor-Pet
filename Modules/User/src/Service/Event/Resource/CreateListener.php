<?php

namespace User\Service\Event\Resource;

use Illuminate\Contracts\Queue\ShouldQueue;

class CreateListener implements ShouldQueue
{
    public function handle(UserCreated $event)
    {

    }
}
