<?php

namespace Specialty\Responder;

use Specialty\Http\Resources\SpecialtyResources;
use Specialty\Support\SpecialtyMessage;
use Symfony\Component\HttpFoundation\Response;
use function response;

class SpecialtyApiResponder
{
    public function list($specialties)
    {
        return SpecialtyResources::collection($specialties);
    }

    public function adminSpecialtyList($specialties)
    {
        return SpecialtyResources::collection($specialties);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($specialty)
    {
        return response()->json([
            'status' => 'success',
            'message' => SpecialtyMessage::$specialtySavedSuccessfully,
            'data' => [
                'specialty' => $specialty,
            ],
        ]);

    }

    public function updatedSuccessfully($specialty)
    {
        return response()->json([
            'status' => 'success',
            'message' => SpecialtyMessage::$specialtyUpdatedSuccessfully,
            'data' => [
                'specialty' => $specialty,
            ],
        ]);

    }

    public function deletedSuccessfully($specialty)
    {
        return response()->json([
            'status' => 'success',
            'message' => SpecialtyMessage::$specialtyDeletedSuccessfully,
            'data' => [
                'specialty' => $specialty,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => SpecialtyMessage::$specialtyRestoredSuccessfully,
        ]);
    }
    public function enabledSuccessfully($specialty)
    {
        return response()->json([
            'status' => 'success',
            'message' => SpecialtyMessage::$specialtyEnabledSuccessfully,
            'data' => [
                'specialty' => $specialty,
            ],
        ]);

    }
    public function disabledSuccessfully($specialty)
    {
        return response()->json([
            'status' => 'success',
            'message' => SpecialtyMessage::$specialtyDisabledSuccessfully,
            'data' => [
                'specialty' => $specialty,
            ],
        ]);

    }


}
