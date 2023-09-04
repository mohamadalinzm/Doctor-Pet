<?php

namespace User\Service\Event\Selection;

use User\Service\Event\Driver\AdminUserEvent;

class UserEventService
{
    public function admin()
    {
        return (new AdminUserEvent());
    }

    public function medical()
    {
    }
}
