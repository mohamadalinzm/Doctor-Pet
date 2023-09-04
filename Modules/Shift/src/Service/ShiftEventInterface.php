<?php

namespace Shift\Service;

use Shift\Model\Shift;

interface ShiftEventInterface
{
    public function create(Shift $Shift);

    public function update(Shift $Shift);

    public function delete(Shift $Shift);

}
