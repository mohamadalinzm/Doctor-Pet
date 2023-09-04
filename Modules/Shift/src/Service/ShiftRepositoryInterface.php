<?php

namespace Shift\Service;

use Shift\Model\Shift;

interface ShiftRepositoryInterface
{
    public function fetch(int $id , array $appends , array $select);

    public function store(array $data);

    public function update(array $data,$Shift);

    public function delete(Shift $shift);

    public function list(int $limit , array $appends , array $filters);
}
