<?php

namespace Shift\Service\Transformers\Driver;

use Illuminate\Support\Collection;
use Shift\Model\Shift;
use Shift\Service\ShiftTransformerInterface;
use Shift\Service\Transformers\Resource\AdminShiftListResource;
use Shift\Service\Transformers\Resource\AdminShiftShowResource;

class AdminShiftTransformService implements ShiftTransformerInterface
{

    public function show(Shift $Shift)
    {
        return AdminShiftShowResource::make($Shift);
    }

    public function list(Collection $Shifts)
    {
        return AdminShiftListResource::collection($Shifts);
    }

}
