<?php

namespace User\Service;

interface UserValidationInterface
{
    public function store(array $data);

    public function update(array $data,$userId);
}
