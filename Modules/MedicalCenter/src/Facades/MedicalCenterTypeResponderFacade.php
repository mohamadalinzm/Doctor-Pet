<?php

namespace MedicalCenter\Facades;

use Illuminate\Support\Facades\Facade;
use MedicalCenter\Responder\MedicalCenterTypeApiResponder;
use MedicalCenter\Responder\MedicalCenterTypeWebResponder;

class MedicalCenterTypeResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => MedicalCenterTypeApiResponder::class,
                'Web' => MedicalCenterTypeWebResponder::class,
            ][$response] ?? MedicalCenterTypeWebResponder::class;
    }
}
