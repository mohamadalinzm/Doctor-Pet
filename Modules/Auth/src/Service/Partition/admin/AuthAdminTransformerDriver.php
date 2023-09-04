<?php

namespace Auth\Service\Partition\admin;

use User\Model\User;
use User\Service\Event\Admin\UserBanned;
use User\Service\Event\Admin\UserChangeActivation;
use User\Service\Event\Admin\UserCreated;
use User\Service\Event\Admin\UserDeleted;
use User\Service\Event\Admin\UserUpdated;
use User\Service\UserEventInterface;

class AuthAdminTransformerDriver implements UserEventInterface
{

    public function ban(User $user)
    {
        event(new UserBanned($user));
    }

    public function activation(User $user)
    {
        event(new UserChangeActivation($user));
    }

    public function create(User $user)
    {
        event(new UserCreated($user));
    }

    public function delete(User $user)
    {
        event(new UserDeleted($user));
    }

    public function update(User $user)
    {
        event(new UserUpdated($user));
    }
}
