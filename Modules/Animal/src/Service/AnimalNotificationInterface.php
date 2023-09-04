<?php

namespace Animal\Service;

interface AnimalNotificationInterface
{
    public function create($user,$Animal);

    public function delete($user,$Animal);

    public function update($user,$Animal);

    public function restore($user,$Animal);

    public function forceDelete($user,$Animal);
}
