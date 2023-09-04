<?php

namespace Animal\Service;

interface AnimalPolicyInterface
{
    public function create($user);

    public function delete($user,$Animal);

    public function update($user,$Animal);

    public function restore($user,$Animal);

    public function forceDelete($user,$Animal);

    public function show($user,$Animal);
}
