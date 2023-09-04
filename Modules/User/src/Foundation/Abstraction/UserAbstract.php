<?php

namespace User\Foundation\Abstraction;

use User\Service\Event\Selection\UserEventService;
use User\Service\Repository\UserRepositoryService;
use User\Service\Response\Selection\UserResponseService;
use User\Service\Transformer\Selection\UserTransformerService;
use User\Service\Validation\Selection\UserValidationService;

abstract class UserAbstract
{

    public function repository()
    {
        return (new UserRepositoryService());
    }


    public function validation()
    {
        return (new UserValidationService());
    }


    public function response()
    {
        return (new UserResponseService());
    }


    public function event()
    {
        return (new UserEventService());
    }


    public function transformers()
    {
        return (new UserTransformerService());
    }


}