<?php

namespace Shift\Service\Event\Resource;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Shift\Model\Shift;

class ShiftUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Shift $Shift)
    {
        $this->Shift = $Shift;
    }
}
