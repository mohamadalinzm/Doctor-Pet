<?php

namespace Pet\Service;

use Pet\Model\Pet;
use User\Model\User;

interface PetEventInterface
{
    public function create($user, Pet $Pet);

    public function update($user, Pet $Pet);

    public function delete($user, Pet $Pet);

    public function show($user, Pet $Pet);

    public function list($user);

    public function setAsDefault($user, Pet $Pet);
}
