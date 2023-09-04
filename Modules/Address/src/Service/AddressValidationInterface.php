<?php

namespace Address\Service;

interface AddressValidationInterface
{
    public function store(array $data);

    public function update(array $data , $addressId);

    public function setAsDefault(array $data);

    public function list(array $data);
}
