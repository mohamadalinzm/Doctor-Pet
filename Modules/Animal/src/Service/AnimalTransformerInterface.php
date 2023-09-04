<?php

namespace Animal\Service;

use Animal\Model\Animal;
use Illuminate\Support\Collection;
use User\Model\User;

interface AnimalTransformerInterface
{
    public function show(Animal $Animal);

    public function list(collection $Animales);
}
