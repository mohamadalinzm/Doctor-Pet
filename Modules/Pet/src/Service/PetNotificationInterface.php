<?php

namespace Pet\Service;

interface PetNotificationInterface
{
    public function create($user,$Pet);

    public function delete($user,$Pet);

    public function update($user,$Pet);

    public function set($user,$Pet);

    public function restore($user,$Pet);

    public function forceDelete($user,$Pet);
}
