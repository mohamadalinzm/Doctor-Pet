<?php

namespace Specialty\Repository\Contracts;

use Specialty\Models\Specialty;

interface SpecialtyRepository
{
    public function show(Specialty $specialty);

    public function index();

    public function delete(Specialty $specialty);

    public function store($data): Specialty;

    public function update(Specialty $specialty, $data);

}
