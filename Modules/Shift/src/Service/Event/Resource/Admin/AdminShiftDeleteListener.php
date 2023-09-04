<?php

namespace Shift\Service\Event\Resource\Admin;

use Illuminate\Contracts\Queue\ShouldQueue;
use Shift\Event\ShiftDeleted;

class AdminShiftDeleteListener implements ShouldQueue
{

    public function handle(AdminShiftDeleted $event)
    {
        //
    }
}
