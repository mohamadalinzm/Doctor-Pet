<?php

namespace User\Service\Transformer\Selection;

use User\Service\Transformer\Driver\AdminUserTransformer;

class UserTransformerService
{
    public function admin()
    {
        return (new AdminUserTransformer());
    }

    public function medical()
    {
    }
}
