<?php

namespace User\Service\Event\Resource;

use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteListener implements ShouldQueue
{

    public function handle(UserDeleted $event)
    {
        //
    }
}
