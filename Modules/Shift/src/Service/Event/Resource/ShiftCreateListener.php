<?php

namespace Shift\Service\Event\Resource;

use Illuminate\Contracts\Queue\ShouldQueue;
use Shift\Event\ShiftCreated;

class ShiftCreateListener implements ShouldQueue
{
    public function handle(ShiftCreated $event)
    {

    }
}
