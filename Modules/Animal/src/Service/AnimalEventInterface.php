<?php

namespace Animal\Service;

use Animal\Model\Animal;
use User\Model\User;

interface AnimalEventInterface
{
    public function create($user, Animal $Animal);

    public function update($user, Animal $Animal);

    public function delete($user, Animal $Animal);

    public function show($user, Animal $Animal);

    public function list($user);

}
