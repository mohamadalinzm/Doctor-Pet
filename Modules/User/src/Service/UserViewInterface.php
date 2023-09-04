<?php

namespace User\Service;

use Illuminate\Support\Collection;
use User\Model\User;

interface UserViewInterface
{
    public function list(Collection $data);

    public function create(array $data);

    public function edit(array $data, User $user);

    public function show(array $data);
}
