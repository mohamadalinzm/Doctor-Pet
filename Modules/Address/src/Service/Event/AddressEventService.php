<?php

namespace Address\Service\Event;

use Address\Model\Address;
use Address\Service\AddressEventInterface;
use Address\Service\Event\Resource\AddressCreated;
use Address\Service\Event\Resource\AddressDeleted;
use Address\Service\Event\Resource\AddressSetDefaultUpdated;
use Address\Service\Event\Resource\AddressUpdated;

class AddressEventService implements AddressEventInterface
{

    public function create($user, Address $address)
    {
        //event(new AddressCreated($user,$address));
    }

    public function update($user, Address $address)
    {
        //event(new AddressUpdated($user,$address));
    }

    public function show($user, Address $address)
    {
        //event(new AddressUpdated($user,$address));
    }

    public function delete($user, Address $address)
    {
        // event(new AddressDeleted($user,$address));
    }

    public function setAsDefault($user, Address $address)
    {
        event(new AddressSetDefaultUpdated($user,$address));
    }

    public function list($user)
    {
        // TODO: Implement list() method.
    }
}
