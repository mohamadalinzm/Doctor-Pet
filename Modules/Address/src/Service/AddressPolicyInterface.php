<?php

namespace Address\Service;

interface AddressPolicyInterface
{
    public function create($user);

    public function delete($user,$address);

    public function update($user,$address);

    public function set($user,$address);

    public function restore($user,$address);

    public function forceDelete($user,$address);

    public function show($user,$address);
}
