<?php

namespace User;

use User\Model\User;

interface UserInterface
{
    public function store(array $data);

    public function update(array $data, $user);

    public function delete(User $user);

    public function show(array $user);


    public function list(array $appends);

    public function fetch(int $id);

    public function information();

}
