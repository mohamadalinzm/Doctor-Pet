<?php

namespace Animal\Service\Transformer;

use Animal\Model\Animal;
use Animal\Service\AnimalTransformerInterface;
use Animal\Service\Transformer\Resource\AnimalListResource;
use Animal\Service\Transformer\Resource\AnimalShowResource;
use Illuminate\Support\Collection;

class AnimalTransformService implements AnimalTransformerInterface
{

    public function show(Animal $Animal)
    {
        return AnimalShowResource::make($Animal);
    }

    public function list(Collection $Animales)
    {
        return AnimalListResource::collection($Animales);
    }
}
