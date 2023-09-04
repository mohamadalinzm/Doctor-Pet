<?php

namespace User\Service;

use User\Model\User;

interface UserEventInterface
{
    public function create(User $user);

    public function update(User $user);

    public function delete(User $user);

}
