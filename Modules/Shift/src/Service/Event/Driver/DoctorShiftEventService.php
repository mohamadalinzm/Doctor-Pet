<?php

namespace Shift\Service\Event\Driver;
use Shift\Model\Shift;
use Shift\Service\Event\Resource\ShiftCreated;
use Shift\Service\Event\Resource\ShiftDeleted;
use Shift\Service\Event\Resource\ShiftUpdated;

class DoctorShiftEventService
{


    public function create(Shift $Shift)
    {
        event(new ShiftCreated($Shift));
    }

    public function update(Shift $Shift)
    {
        event(new ShiftUpdated($Shift));
    }

    public function delete(Shift $Shift)
    {
        event(new ShiftDeleted($Shift));
    }
}
