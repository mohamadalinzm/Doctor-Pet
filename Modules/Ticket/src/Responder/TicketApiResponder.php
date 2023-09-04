<?php

namespace Ticket\Responder;

use Ticket\Http\Resources\TicketResource;
use Ticket\Support\TicketMessage;
use Symfony\Component\HttpFoundation\Response;

use function response;

class TicketApiResponder
{
    public function list($tickets)
    {
        return TicketResource::collection($tickets);
    }

    public function adminMedicalCenterList($tickets)
    {
        return TicketResource::collection($tickets);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($ticket)
    {
        return response()->json([
            'status' => 'success',
            'message' => TicketMessage::$ticketSavedSuccessfully,
            'data' => [
                'ticket' => $ticket,
            ],
        ]);

    }

    public function updatedSuccessfully($ticket)
    {
        return response()->json([
            'status' => 'success',
            'message' => TicketMessage::$ticketUpdatedSuccessfully,
            'data' => [
                'ticket' => $ticket,
            ],
        ]);

    }

    public function deletedSuccessfully($ticket)
    {
        return response()->json([
            'status' => 'success',
            'message' => TicketMessage::$ticketDeletedSuccessfully,
            'data' => [
                'ticket' => $ticket,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => TicketMessage::$ticketRestoredSuccessfully,
        ]);
    }

}
