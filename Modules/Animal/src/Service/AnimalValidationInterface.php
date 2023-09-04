<?php

namespace Animal\Service;

interface AnimalValidationInterface
{
    public function store(array $data);

    public function update(array $data , $AnimalId);

    public function list(array $data);
}
