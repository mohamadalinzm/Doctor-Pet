<?php

namespace Shift\Service;

use Illuminate\Support\Collection;
use Shift\Model\Shift;

interface ShiftTransformerInterface
{
    public function show(Shift $Shift);

    public function list(collection $Shiftes);
}
