<?php

namespace Pet\Service\Transformer;

use Pet\Model\Pet;
use Pet\Service\PetTransformerInterface;
use Pet\Service\Transformer\Resource\PetListResource;
use Pet\Service\Transformer\Resource\PetShowResource;
use Illuminate\Support\Collection;

class PetTransformService implements PetTransformerInterface
{

    public function show(Pet $Pet)
    {
        return PetShowResource::make($Pet);
    }

    public function list(Collection $Petes)
    {
        return PetListResource::collection($Petes);
    }
}
