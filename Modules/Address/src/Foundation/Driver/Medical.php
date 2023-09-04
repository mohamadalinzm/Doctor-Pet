<?php

namespace Address\Foundation\Driver;

use Address\AddressInterface;
use Address\Foundation\Abstraction\AddressAbstract;
use Address\Model\Address;
use User\Model\User;

class Medical extends AddressAbstract
{
    public function store($user)
    {
        // Check Address Validation
        $data = $this->validation()->store(request()->all());

        // Check Store Policy
        $this->policy()->create($user);

        // Save And Retrieve Address
        $address = $this->action()->store($data, $user);

        // Run Event For Address Generating
        $this->event()->create($user, $address);
    }

    public function update($user, $addressId)
    {
        // Check Address Validation For Update
        $data = $this->validation()->update(request()->all(), $addressId);

        // Check Is Address Existed
        $address = $this->action()->fetch($addressId);

        // Check Address Update Policy
        $this->policy()->update($user, $address);

        // Update The Address
        $this->action()->update($data, $addressId);

        // Run Address Update Event
        $this->event()->update($user, $address);
    }

    public function delete($user, $addressId)
    {
        // Check Is Address Existed
        $address = $this->action()->fetch($addressId);

        // Check Address Delete Policy
        $this->policy()->delete($user, $address);

        // Delete The Address
        $this->action()->delete($addressId);

        // Run Event Of Address Deleted
        $this->event()->delete($user, $address);
    }

    public function show($user, $addressId)
    {
        // Check Is Address Existed
        $address = $this->action()->fetch($addressId);

        // Check Address Update Policy
        $this->policy()->show($user, $address);

        // Run Address Update Event
        $this->event()->update($user, $address);
    }

    public function list($user, $limit, $appends)
    {
        // List The Addresses
        $addresses = $this->action()->list($user, $appends, [], $limit);

        // Run Event That User Show Address List
        $this->event()->list($user);
    }
}