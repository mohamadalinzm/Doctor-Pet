<?php

namespace Shift\Service\Event\Resource;

use Illuminate\Contracts\Queue\ShouldQueue;
use Shift\Event\ShiftDeleted;

class ShiftDeleteListener implements ShouldQueue
{

    public function handle(ShiftDeleted $event)
    {
        //
    }
}
