<?php

namespace Animal\Service\Event;

use Animal\Model\Animal;
use Animal\Service\AnimalEventInterface;

class AnimalEventService implements AnimalEventInterface
{

    public function create($user, Animal $Animal)
    {
        //event(new AnimalCreated($user,$Animal));
    }

    public function update($user, Animal $Animal)
    {
        //event(new AnimalUpdated($user,$Animal));
    }

    public function show($user, Animal $Animal)
    {
        //event(new AnimalUpdated($user,$Animal));
    }

    public function delete($user, Animal $Animal)
    {
        // event(new AnimalDeleted($user,$Animal));
    }


    public function list($user)
    {
        // TODO: Implement list() method.
    }
}
