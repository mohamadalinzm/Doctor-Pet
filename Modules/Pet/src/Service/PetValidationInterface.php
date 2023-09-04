<?php

namespace Pet\Service;

interface PetValidationInterface
{
    public function store(array $data);

    public function update(array $data , $PetId);

    public function list(array $data);
}
