<?php

namespace User\Service\Response\Selection;

use User\Service\Response\Resource\AdminUserResponse;

class UserResponseService
{
    public function admin()
    {
        return (new AdminUserResponse());
    }

    public function medical()
    {
    }
}
