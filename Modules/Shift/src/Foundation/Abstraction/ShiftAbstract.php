<?php

namespace Shift\Foundation\Abstraction;

use Shift\Service\ShiftEventInterface;
use Shift\Service\ShiftRepositoryInterface;
use Shift\Service\ShiftResponseInterface;
use Shift\Service\ShiftTransformerInterface;
use Shift\Service\ShiftValidationInterface;
use User\Service\UserRepositoryInterface;

abstract class ShiftAbstract
{
    public $ShiftRepository;

    public $UserRepository;

    public $event;

    public $transformer;

    public $validation;

    public $response;


    public function __construct()
    {
        $this->ShiftRepository = app(ShiftRepositoryInterface::class);
        $this->UserRepository = app(UserRepositoryInterface::class);
        $this->event = app(ShiftEventInterface::class);
        $this->transformer = app(ShiftTransformerInterface::class);
        $this->validation = app(ShiftValidationInterface::class);
        $this->response = app(ShiftResponseInterface::class);
    }
}