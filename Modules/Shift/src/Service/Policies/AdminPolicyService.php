<?php

namespace Shift\Service\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Shift\Model\Shift;
use Shift\Service\ShiftPolicyInterface;
use User\Model\User;

class AdminPolicyService implements ShiftPolicyInterface
{
    use HandlesAuthorization;
    use AuthorizesRequests;

    public function list(User $user): bool
    {
        return true;
    }

    public function show(User $user, Shift $shift): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return true;
    }

    public function update(User $user, Shift $shift): bool
    {
        return true;
    }

    public function delete(User $user, Shift $shift): bool
    {
        return true;
    }
}
