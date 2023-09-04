<?php

namespace Shift;

use Shift\Model\Shift;
use User\Model\User;

interface ShiftInterface
{
    public function store(array $data);

    public function update(array $data, $shiftId);

    public function delete($shiftId);

    public function list(array $appends , array $filters , int $limit);

    public function fetch(int $shiftId);
}
