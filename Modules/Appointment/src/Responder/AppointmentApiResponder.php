<?php

namespace Appointment\Responder;

use Appointment\Http\Resources\AppointmentResource;
use Appointment\Support\AppointmentMessage;
use Symfony\Component\HttpFoundation\Response;

use function response;

class AppointmentApiResponder
{
    public function list($appointments)
    {
        return AppointmentResource::collection($appointments);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($appointment)
    {
        return response()->json([
            'status' => 'success',
            'message' => AppointmentMessage::$appointmentSavedSuccessfully,
            'data' => [
                'appointment' => $appointment,
            ],
        ]);

    }

    public function updatedSuccessfully($appointment)
    {
        return response()->json([
            'status' => 'success',
            'message' => AppointmentMessage::$appointmentUpdatedSuccessfully,
            'data' => [
                'appointment' => $appointment,
            ],
        ]);

    }

    public function deletedSuccessfully($appointment)
    {
        return response()->json([
            'status' => 'success',
            'message' => AppointmentMessage::$appointmentDeletedSuccessfully,
            'data' => [
                'appointment' => $appointment,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => AppointmentMessage::$appointmentRestoredSuccessfully,
        ]);
    }

}
