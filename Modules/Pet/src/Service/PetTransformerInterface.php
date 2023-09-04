<?php

namespace Pet\Service;

use Pet\Model\Pet;
use Illuminate\Support\Collection;
use User\Model\User;

interface PetTransformerInterface
{
    public function show(Pet $Pet);

    public function list(collection $Petes);
}
