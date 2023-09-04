<?php

namespace Shift\Service;

interface ShiftValidationInterface
{
    public function store(array $data);

    public function update(array $data,$ShiftId);

    public function list(array $data);
}
