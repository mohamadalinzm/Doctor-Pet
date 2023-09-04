<?php

namespace Shift\Service\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Shift\Model\Shift;
use Shift\Service\ShiftPolicyInterface;
use User\Model\User;

class DoctorPolicyService implements ShiftPolicyInterface
{

    use HandlesAuthorization;
    use AuthorizesRequests;

    public function list(User $user): bool
    {

    }

    public function show(User $user, Shift $shift): bool
    {
        if ($user->isDoctor()) {
            return $user->id === $shift->doctor_id;
        }

        return false;
    }


    public function store(User $user): bool
    {
        return $user->isDoctor();
    }


    public function update(User $user, Shift $shift): bool
    {
        if ($user->isDoctor()) {
            return $user->id === $shift->doctor_id;
        }

        return false;
    }


    public function delete(User $user, Shift $shift): bool
    {
        if ($user->isDoctor()) {
            return $user->id === $shift->doctor_id;
        }

        return false;
    }
}
