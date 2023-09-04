<?php

namespace MedicalCenter\Repository\Contracts;

use MedicalCenter\Models\MedicalCenterType;

interface MedicalCenterTypeRepository
{
    public function show(MedicalCenterType $type);

    public function index();

    public function delete(MedicalCenterType $type);

    public function store($data): MedicalCenterType;

    public function update(MedicalCenterType $type, $data);

}
