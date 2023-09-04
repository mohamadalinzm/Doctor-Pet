<?php

namespace Address\Foundation\Abstraction;

use Address\Service\Action\AddressActionService;
use Address\Service\Event\AddressEventService;
use Address\Service\Notification\AddressNotificationService;
use Address\Service\Policy\AddressPolicyService;
use Address\Service\Repository\Resource\AddressRepositoryService;
use Address\Service\Response\AddressResponseService;
use Address\Service\Transformer\AddressTransformService;
use Address\Service\Validation\AddressValidationService;

abstract class AddressAbstract
{

    public function event()
    {
        return new AddressEventService;
    }

    public function notification()
    {
        return new AddressNotificationService;
    }

    public function policy()
    {
        return new AddressPolicyService;
    }

    public function repository()
    {
        return (new AddressRepositoryService);
    }

    public function response()
    {
        return new AddressResponseService;
    }

    public function transformer()
    {
        return new AddressTransformService;
    }

    public function validation()
    {
        return new AddressValidationService;
    }

    public function action()
    {
        return new AddressActionService;
    }
}