<?php

namespace MedicalCenter\Facades;

use Illuminate\Support\Facades\Facade;
use MedicalCenter\Responder\Service\ServiceApiResponder;
use MedicalCenter\Responder\Service\ServiceWebResponder;

class ServiceResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => ServiceApiResponder::class,
                'Web' => ServiceWebResponder::class,
            ][$response] ?? ServiceWebResponder::class;
    }
}
