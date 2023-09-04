<?php

namespace User\Service\Validation\Selection;

use User\Service\Validation\Driver\AdminValidation;

class UserValidationService
{
    public function admin()
    {
        return (new AdminValidation());
    }

    public function medical()
    {
    }
}
