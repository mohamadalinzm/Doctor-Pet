<?php

namespace Address\Foundation\Service;

use Address\AddressInterface;
use Address\Foundation\Abstraction\AddressAbstract;
use Address\Foundation\Driver\Costumer;
use Address\Model\Address;
use Address\Service\Event\AddressEventService;

class AddressService extends AddressAbstract
{
    public function costumer()
    {
        return new Costumer;
    }
}