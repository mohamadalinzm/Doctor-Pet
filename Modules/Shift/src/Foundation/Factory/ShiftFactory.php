<?php

namespace Shift\Foundation\Factory;

use Shift\Foundation\Driver\AdminShiftDriver;
use Shift\Foundation\Driver\DoctorShiftDriver;
use Shift\Foundation\Service\ShiftService;
use Shift\Service\Event\Driver\AdminShiftEventService;
use Shift\Service\Event\Driver\DoctorShiftEventService;
use Shift\Service\Response\AdminJsonResponse;
use Shift\Service\Response\ShiftDoctorJsonResponse;
use Shift\Service\ShiftEventInterface;
use Shift\Service\ShiftResponseInterface;
use Shift\Service\ShiftTransformerInterface;
use Shift\Service\ShiftValidationInterface;
use Shift\Service\Transformers\Driver\AdminShiftTransformService;
use Shift\Service\Transformers\Driver\DoctorShiftTransformService;
use Shift\Service\Validation\Driver\AdminShiftValidationService;
use Shift\Service\Validation\Driver\DoctorShiftValidationService;
use Shift\ShiftInterface;

class ShiftFactory
{

    public static function factory($route)
    {
        if (self::isUser($route)) {
            return self::installDoctorShift();
        }elseif (self::isAdmin($route)) {
            return self::installAdmin();
        }
        return false;
    }

    private static function installDoctorShift()
    {
        app()->bind(ShiftValidationInterface::class, DoctorShiftValidationService::class);
        app()->bind(ShiftResponseInterface::class, ShiftDoctorJsonResponse::class);
        app()->bind(ShiftEventInterface::class, DoctorShiftEventService::class);
        app()->bind(ShiftTransformerInterface::class, DoctorShiftTransformService::class);
        app()->bind(ShiftInterface::class, DoctorShiftDriver::class);

        return (new ShiftService());
    }

    private static function installAdmin()
    {
        app()->bind(ShiftValidationInterface::class, AdminShiftValidationService::class);
        app()->bind(ShiftResponseInterface::class, AdminJsonResponse::class);
        app()->bind(ShiftEventInterface::class, AdminShiftEventService::class);
        app()->bind(ShiftTransformerInterface::class, AdminShiftTransformService::class);
        app()->bind(ShiftInterface::class, AdminShiftDriver::class);

        return (new ShiftService());
    }

    private static function isUser($route): bool
    {
        return $route == 'doctor/shift-management';
    }

    private static function isAdmin($route): bool
    {
        return $route == 'admin/shift-management';
    }

}