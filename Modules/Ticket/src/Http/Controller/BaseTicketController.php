<?php

namespace Ticket\Http\Controller;

use App\Http\Controllers\Controller;
use Ticket\Repository\Contracts\TicketRepository;

class BaseTicketController extends Controller
{
    public $ticketRepository;

    public function __construct()
    {
        $this->ticketRepository = resolve(TicketRepository::class);
    }
}
