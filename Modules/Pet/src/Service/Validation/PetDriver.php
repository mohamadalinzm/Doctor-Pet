<?php

namespace Pet\Service\Validation;
use Pet\Service\PetResponseInterface;
use Pet\Service\PetValidationInterface;
use Pet\Service\Validation\Resource\PetListValidator;
use Pet\Service\Validation\Resource\PetStoreValidator;
use Pet\Service\Validation\Resource\PetUpdateValidator;

class PetDriver implements PetValidationInterface
{

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update(array $data, $PetId)
    {
        // TODO: Implement update() method.
    }

    public function list(array $data)
    {
        // TODO: Implement list() method.
    }
}
