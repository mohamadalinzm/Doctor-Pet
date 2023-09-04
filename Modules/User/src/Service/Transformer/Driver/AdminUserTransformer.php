<?php

namespace User\Service\Transformer\Driver;

use User\Model\User;
use User\Service\Transformer\Resource\AdminListResource;
use User\Service\Transformer\Resource\AdminUserResource;

class AdminUserTransformer
{
    public function show(User $user)
    {
        return AdminUserResource::make($user);
    }

    public function list(User $user)
    {
        return AdminListResource::collection($user);
    }
}
