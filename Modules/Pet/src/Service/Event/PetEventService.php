<?php

namespace Pet\Service\Event;

use Pet\Model\Pet;
use Pet\Service\PetEventInterface;

class PetEventService implements PetEventInterface
{

    public function create($user, Pet $Pet)
    {
        //event(new PetCreated($user,$Pet));
    }

    public function update($user, Pet $Pet)
    {
        //event(new PetUpdated($user,$Pet));
    }

    public function show($user, Pet $Pet)
    {
        //event(new PetUpdated($user,$Pet));
    }

    public function delete($user, Pet $Pet)
    {
        // event(new PetDeleted($user,$Pet));
    }

    public function setAsDefault($user, Pet $Pet)
    {
        event(new PetSetDefaultUpdated($user,$Pet));
    }

    public function list($user)
    {
        // TODO: Implement list() method.
    }
}
