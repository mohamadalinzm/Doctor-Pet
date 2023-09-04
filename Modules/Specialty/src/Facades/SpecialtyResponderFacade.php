<?php

namespace Specialty\Facades;

use Illuminate\Support\Facades\Facade;
use Specialty\Responder\SpecialtyApiResponder;

class SpecialtyResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => SpecialtyApiResponder::class,
                'Web' => SpecialtyApiResponder::class,
            ][$response] ?? SpecialtyApiResponder::class;
    }
}
