<?php

namespace MedicalCenter\Responder\Type;

use MedicalCenter\Http\Resources\MedicalCenterTypeResource;
use MedicalCenter\Support\Type\MedicalCenterTypeMessage;
use Symfony\Component\HttpFoundation\Response;
use function response;

class MedicalCenterTypeApiResponder
{
    public function list($types)
    {
        return MedicalCenterTypeResource::collection($types);
    }

    public function adminMedicalCenterList($types)
    {
        return MedicalCenterTypeResource::collection($types);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($type)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterTypeMessage::$typeSavedSuccessfully,
            'data' => [
                'type' => $type,
            ],
        ]);

    }

    public function updatedSuccessfully($type)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterTypeMessage::$typeUpdatedSuccessfully,
            'data' => [
                'type' => $type,
            ],
        ]);

    }

    public function deletedSuccessfully($type)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterTypeMessage::$typeDeletedSuccessfully,
            'data' => [
                'type' => $type,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterTypeMessage::$typeRestoredSuccessfully,
        ]);
    }
    public function enabledSuccessfully($type)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterTypeMessage::$typeEnabledSuccessfully,
            'data' => [
                'type' => $type,
            ],
        ]);

    }
    public function disabledSuccessfully($type)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterTypeMessage::$typeDisabledSuccessfully,
            'data' => [
                'type' => $type,
            ],
        ]);

    }


}
