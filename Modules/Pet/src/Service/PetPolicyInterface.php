<?php

namespace Pet\Service;

interface PetPolicyInterface
{
    public function create($user);

    public function delete($user,$Pet);

    public function update($user,$Pet);

    public function restore($user,$Pet);

    public function forceDelete($user,$Pet);

    public function show($user,$Pet);
}
