<?php

namespace MedicalCenter\Repository\Contracts;

use MedicalCenter\Models\Service;

interface ServiceRepository
{
    public function show(Service $service);

    public function index();

    public function delete(Service $service);

    public function store($data): Service;

    public function update(Service $service, $data);

}
