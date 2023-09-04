<?php

namespace Shift\Service\Event\Resource\Admin;

use Illuminate\Contracts\Queue\ShouldQueue;

class AdminShiftUpdateListener implements ShouldQueue
{
    public function handle(AdminShiftCreated $event)
    {
        //
    }
}
