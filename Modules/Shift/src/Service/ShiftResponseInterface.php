<?php

namespace Shift\Service;

use Shift\Model\Shift;

interface ShiftResponseInterface
{
    public function ShiftDeletedSuccess();

    public function ShiftValidationFailed($errors);

    public function ShiftStoredSuccess(Shift $shift);

    public function ShiftUpdatedSuccess(Shift $shift);

    public function ShiftNotFound();
}
