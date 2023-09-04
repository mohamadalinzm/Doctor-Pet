<?php

namespace Animal\Foundation\Abstraction;

use Animal\Service\Action\AnimalActionService;
use Animal\Service\Event\AnimalEventService;
use Animal\Service\Notification\AnimalNotificationService;
use Animal\Service\Policy\AnimalPolicyService;
use Animal\Service\Repository\Resource\AnimalRepositoryService;
use Animal\Service\Response\AnimalResponseService;
use Animal\Service\Transformer\AnimalTransformService;
use Animal\Service\Validation\AnimalValidationService;

abstract class AnimalAbstract
{

    public function event()
    {
        return new AnimalEventService;
    }

    public function notification()
    {
        return new AnimalNotificationService;
    }

    public function policy()
    {
        return new AnimalPolicyService;
    }

    public function repository()
    {
        return (new AnimalRepositoryService);
    }

    public function response()
    {
        return new AnimalResponseService;
    }

    public function transformer()
    {
        return new AnimalTransformService;
    }

    public function validation()
    {
        return new AnimalValidationService;
    }

    public function action()
    {
        return new AnimalActionService;
    }
}