<?php

namespace MedicalCenter\Repository\Contracts;

use MedicalCenter\Models\MedicalCenter;

interface MedicalCenterRepository
{
    public function show(MedicalCenter $medicalCenter);

    public function index();

    public function delete(MedicalCenter $medicalCenter);

    public function store($data): MedicalCenter;

    public function update(MedicalCenter $medicalCenter, $data);
    
}
