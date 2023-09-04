<?php

namespace Pet\Foundation\Abstraction;

use Pet\Service\Action\PetActionService;
use Pet\Service\Event\PetEventService;
use Pet\Service\Notification\PetNotificationService;
use Pet\Service\Policy\PetPolicyService;
use Pet\Service\Repository\Resource\PetRepositoryService;
use Pet\Service\Response\PetResponseService;
use Pet\Service\Transformer\PetTransformService;
use Pet\Service\Validation\PetValidationService;

abstract class PetAbstract
{

    public function event()
    {
        return new PetEventService;
    }

    public function notification()
    {
        return new PetNotificationService;
    }

    public function policy()
    {
        return new PetPolicyService;
    }

    public function repository()
    {
        return (new PetRepositoryService);
    }

    public function response()
    {
        return new PetResponseService;
    }

    public function transformer()
    {
        return new PetTransformService;
    }

    public function validation()
    {
        return new PetValidationService;
    }

    public function action()
    {
        return new PetActionService;
    }
}