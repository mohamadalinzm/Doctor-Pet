<?php

namespace Appointment\Responder;

use Appointment\Http\Resources\ShiftResource;
use Appointment\Support\ShiftMessage;
use Symfony\Component\HttpFoundation\Response;

use function response;

class ShiftApiResponder
{
    public function list($shifts)
    {
        return ShiftResource::collection($shifts);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($shift)
    {
        return response()->json([
            'status' => 'success',
            'message' => ShiftMessage::$shiftSavedSuccessfully,
            'data' => [
                'shift' => $shift,
            ],
        ]);

    }

    public function updatedSuccessfully($shift)
    {
        return response()->json([
            'status' => 'success',
            'message' => ShiftMessage::$shiftUpdatedSuccessfully,
            'data' => [
                'shift' => $shift,
            ],
        ]);

    }

    public function deletedSuccessfully($shift)
    {
        return response()->json([
            'status' => 'success',
            'message' => ShiftMessage::$shiftDeletedSuccessfully,
            'data' => [
                'shift' => $shift,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => ShiftMessage::$shiftRestoredSuccessfully,
        ]);
    }

}
