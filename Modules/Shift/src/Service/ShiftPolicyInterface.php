<?php

namespace Shift\Service;

use Shift\Model\Shift;
use User\Model\User;

interface ShiftPolicyInterface
{
    public function list(User $user): bool;

    public function show(User $user, Shift $shift): bool;

    public function store(User $user): bool;

    public function update(User $user, Shift $shift): bool;

    public function delete(User $user, Shift $shift): bool;
}
