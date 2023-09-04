<?php

namespace Address\Service;

interface AddressNotificationInterface
{
    public function create($user,$address);

    public function delete($user,$address);

    public function update($user,$address);

    public function set($user,$address);

    public function restore($user,$address);

    public function forceDelete($user,$address);
}
