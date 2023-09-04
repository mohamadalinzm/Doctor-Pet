<?php

namespace Ticket\Http\Controller\Admin;


use Ticket\Facades\TicketResponderFacade;
use Ticket\Http\Controller\BaseTicketController;
use Ticket\Http\Validator\TicketValidator;
use Ticket\Models\Ticket;

class TicketController extends BaseTicketController
{

    public function index()
    {
        $tickets = collect();
        $ticketsListCount=0;

        if (request()->wantsJson()) {
            $tickets = $this->ticketRepository->index(request('searchterm'));
        }
        return TicketResponderFacade::adminMedicalCenterList($tickets,$ticketsListCount);
    }


    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = TicketValidator::check($data);
        if ($validator->fails()) {
            return TicketResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // set user_id
        $data['user_id'] = auth()->user()->id;

        $data['ticket_number'] = auth()->user()->id;

        // Store
        $medicalCenter = $this->ticketRepository->store($data);

        // Response
        return TicketResponderFacade::storedSuccessfully($medicalCenter);
    }

    public function update(Ticket $ticket)
    {
        $data = request()->all();

        // Validate Request
        $validator = TicketValidator::check($data);
        if ($validator->fails()) {
            return TicketResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->ticketRepository->update($ticket,$data);

        // Response
        return TicketResponderFacade::updatedSuccessfully($ticket);
    }


    public function destroy(Ticket $ticket)
    {
        //delete product
        $this->ticketRepository->delete($ticket);

        // Response
        return TicketResponderFacade::deletedSuccessfully($ticket);
    }

}
