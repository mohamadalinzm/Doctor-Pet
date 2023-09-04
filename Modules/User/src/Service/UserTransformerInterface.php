<?php

namespace User\Service;

use Illuminate\Support\Collection;
use User\Model\User;

interface UserTransformerInterface
{
    public function show(User $user);

    public function list(collection $users);
}
