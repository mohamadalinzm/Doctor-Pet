<?php

namespace Shift\Service\Event\Driver;
use Shift\Model\Shift;
use Shift\Service\Event\Resource\Admin\AdminShiftCreated;
use Shift\Service\Event\Resource\Admin\AdminShiftDeleted;
use Shift\Service\Event\Resource\Admin\AdminShiftUpdated;

class AdminShiftEventService
{

    public function create(Shift $Shift)
    {
        event(new AdminShiftCreated($Shift));
    }

    public function update(Shift $Shift)
    {
        event(new AdminShiftUpdated($Shift));
    }

    public function delete(Shift $Shift)
    {
        event(new AdminShiftDeleted($Shift));
    }

}
