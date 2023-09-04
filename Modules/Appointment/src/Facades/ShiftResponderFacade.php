<?php

namespace Appointment\Facades;

use Illuminate\Support\Facades\Facade;
use Appointment\Responder\AppointmentApiResponder;
use Appointment\Responder\AppointmentWebResponder;

class ShiftResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => AppointmentApiResponder::class,
                'Web' => AppointmentWebResponder::class,
            ][$response] ?? AppointmentApiResponder::class;
    }
}
