<?php

namespace User\Service\Validation\Driver;


use User\Service\Validation\Resource\AdminUserFilterValidation;
use User\Service\Validation\Resource\AdminUserStoreValidation;
use User\Service\Validation\Resource\AdminUserUpdateValidation;

class AdminValidation
{
    public function store($data)
    {
        return AdminUserStoreValidation::check($data);
    }

    public function update($data, $user)
    {
        return AdminUserUpdateValidation::check($data, $user);
    }

    public function filter($data, $user)
    {
        return AdminUserFilterValidation::check($data, $user);
    }
}
