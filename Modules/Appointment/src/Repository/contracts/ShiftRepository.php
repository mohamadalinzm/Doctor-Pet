<?php

namespace Appointment\Repository\Contracts;

use Appointment\Models\Shift;

interface ShiftRepository
{
    public function show(Shift $shift);

    public function index();

    public function delete(Shift $shift);

    public function store($data);

    public function update(Shift $shift, $data);

}
