<?php

namespace Shift\Service\Event\Resource\Admin;

use Illuminate\Contracts\Queue\ShouldQueue;
use Shift\Event\ShiftCreated;

class AdminShiftCreateListener implements ShouldQueue
{
    public function handle(AdminShiftCreated $event)
    {

    }
}
