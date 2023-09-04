<?php

namespace Appointment\Repository\Contracts;

use Appointment\Models\Appointment;

interface AppointmentRepository
{
    public function show(Appointment $appointment);

    public function index();

    public function delete(Appointment $appointment);

    public function store($data);

    public function update(Appointment $appointment, $data);

}
