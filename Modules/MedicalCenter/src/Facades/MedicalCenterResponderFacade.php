<?php

namespace MedicalCenter\Facades;

use Illuminate\Support\Facades\Facade;
use MedicalCenter\Responder\MedicalCenter\MedicalCenterApiResponder;
use MedicalCenter\Responder\MedicalCenter\MedicalCenterWebResponder;

class MedicalCenterResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
            'Json' => MedicalCenterApiResponder::class,
            'Web' => MedicalCenterWebResponder::class,
        ][$response] ?? MedicalCenterWebResponder::class;
    }
}
