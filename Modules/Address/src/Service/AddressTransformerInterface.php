<?php

namespace Address\Service;

use Address\Model\Address;
use Illuminate\Support\Collection;
use User\Model\User;

interface AddressTransformerInterface
{
    public function show(Address $address);

    public function list(collection $addresses);
}
