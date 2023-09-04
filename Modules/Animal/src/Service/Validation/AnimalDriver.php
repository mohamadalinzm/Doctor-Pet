<?php

namespace Animal\Service\Validation;
use Animal\Service\AnimalResponseInterface;
use Animal\Service\AnimalValidationInterface;
use Animal\Service\Validation\Resource\AnimalListValidator;
use Animal\Service\Validation\Resource\AnimalStoreValidator;
use Animal\Service\Validation\Resource\AnimalUpdateValidator;

class AnimalDriver implements AnimalValidationInterface
{

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update(array $data, $AnimalId)
    {
        // TODO: Implement update() method.
    }

    public function list(array $data)
    {
        // TODO: Implement list() method.
    }
}
