<?php

namespace Pet\Foundation\Service;

use Pet\PetInterface;
use Pet\Foundation\Abstraction\PetAbstract;
use Pet\Foundation\Driver\Costumer;
use Pet\Model\Pet;
use Pet\Service\Event\PetEventService;

class PetService extends PetAbstract
{
    public function costumer()
    {
        return new Costumer;
    }
}