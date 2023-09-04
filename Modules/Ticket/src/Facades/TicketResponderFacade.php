<?php

namespace Ticket\Facades;

use Illuminate\Support\Facades\Facade;
use Ticket\Responder\TicketApiResponder;
use Ticket\Responder\TicketWebResponder;

class TicketResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        $response = 'Web';

        if (request()->wantsJson()) {
            $response = 'Json';
        }

        return [
                'Json' => TicketApiResponder::class,
                'Web' => TicketWebResponder::class,
            ][$response] ?? TicketApiResponder::class;
    }
}
