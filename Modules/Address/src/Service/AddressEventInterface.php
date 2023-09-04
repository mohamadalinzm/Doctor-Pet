<?php

namespace Address\Service;

use Address\Model\Address;
use User\Model\User;

interface AddressEventInterface
{
    public function create($user, Address $address);

    public function update($user, Address $address);

    public function delete($user, Address $address);

    public function show($user, Address $address);

    public function list($user);

    public function setAsDefault($user, Address $address);
}
