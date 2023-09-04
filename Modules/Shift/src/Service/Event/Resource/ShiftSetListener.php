<?php

namespace Shift\Service\Event\Resource;

use Illuminate\Contracts\Queue\ShouldQueue;
use Shift\Event\ShiftUpdated;

class ShiftSetListener implements ShouldQueue
{
    public function handle(ShiftUpdated $event)
    {
        //
    }
}
