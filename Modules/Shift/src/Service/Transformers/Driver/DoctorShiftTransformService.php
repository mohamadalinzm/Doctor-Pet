<?php

namespace Shift\Service\Transformers\Driver;

use Illuminate\Support\Collection;
use Shift\Model\Shift;
use Shift\Service\ShiftTransformerInterface;
use Shift\Service\Transformers\Resource\DoctorShiftListResource;
use Shift\Service\Transformers\Resource\DoctorShiftShowResource;

class DoctorShiftTransformService implements ShiftTransformerInterface
{
    public function show(Shift $Shift)
    {
        return DoctorShiftShowResource::make($Shift);
    }

    public function list(Collection $Shifts)
    {
        return DoctorShiftListResource::collection($Shifts);
    }
}
