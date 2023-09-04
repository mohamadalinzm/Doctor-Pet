<?php

namespace Address\Service\Policy;

use Address\Model\Address;
use Address\Service\AddressEventInterface;
use Address\Service\AddressPolicyInterface;
use Address\Service\Event\Resource\AddressCreated;
use Address\Service\Event\Resource\AddressDeleted;
use Address\Service\Event\Resource\AddressSetDefaultUpdated;
use Address\Service\Event\Resource\AddressUpdated;

class AddressPolicyService implements AddressPolicyInterface
{

    public function create($user)
    {
        return true;
    }

    public function delete($user, $address)
    {
        //if ($user->id == $address->user_id) {
        //    return true;
        //}
        //
        //return false;
        return true;
    }

    public function update($user, $address)
    {
        //if ($user->id == $address->user_id) {
        //    return true;
        //}
        //
        //return false;
        return true;
    }

    public function set($user, $address)
    {
        // TODO: Implement set() method.
    }

    public function restore($user, $address)
    {
        // TODO: Implement restore() method.
    }

    public function forceDelete($user, $address)
    {
        // TODO: Implement forceDelete() method.
    }

    public function show($user, $address)
    {
        //if ($user->id == $address->user_id) {
        //    return true;
        //}
        //
        //return false;
        return true;
    }
}
