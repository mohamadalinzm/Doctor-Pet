<?php

namespace User\Service;

use User\Model\User;

interface UserRepositoryInterface
{
    public function fetch(int $id , array $append);

    public function store(array $data);

    public function update(array $data,User $user);

    public function delete(User $user);

    public function list(int $limit , array $appends);

    public function information();

    public function fetchUserByMobile($mobile);
}
