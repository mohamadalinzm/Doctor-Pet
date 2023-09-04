<?php

namespace Address\Service\Transformer;

use Address\Model\Address;
use Address\Service\AddressTransformerInterface;
use Address\Service\Transformer\Resource\AddressListResource;
use Address\Service\Transformer\Resource\AddressShowResource;
use Illuminate\Support\Collection;

class AddressTransformService implements AddressTransformerInterface
{

    public function show(Address $address)
    {
        return AddressShowResource::make($address);
    }

    public function list(Collection $addresses)
    {
        return AddressListResource::collection($addresses);
    }
}
