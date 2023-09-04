<?php

namespace User\Service\Event\Driver;

use User\Model\User;
use User\Service\Event\Resource\UserCreated;
use User\Service\Event\Resource\UserDeleted;
use User\Service\Event\Resource\UserUpdated;

class AdminUserEvent
{

    public function create(User $user)
    {
        event(new UserCreated($user));
    }

    public function update(User $user)
    {
        event(new UserUpdated($user));
    }

    public function delete(User $user)
    {
        event(new UserDeleted($user));
    }
}
