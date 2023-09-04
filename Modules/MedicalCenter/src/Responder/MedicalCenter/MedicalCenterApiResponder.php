<?php

namespace MedicalCenter\Responder\MedicalCenter;

use MedicalCenter\Http\Resources\MedicalCenterResource;
use MedicalCenter\Support\MedicalCenter\MedicalCenterMessage;
use Symfony\Component\HttpFoundation\Response;
use function response;

class MedicalCenterApiResponder
{
    public function list($medicalCenters)
    {
        return MedicalCenterResource::collection($medicalCenters);
    }

    public function adminMedicalCenterList($medicalCenters)
    {
        return MedicalCenterResource::collection($medicalCenters);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($medicalCenter)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterMessage::$medicalCenterSavedSuccessfully,
            'data' => [
                'medicalCenter' => $medicalCenter,
            ],
        ]);

    }

    public function updatedSuccessfully($medicalCenter)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterMessage::$medicalCenterUpdatedSuccessfully,
            'data' => [
                'medicalCenter' => $medicalCenter,
            ],
        ]);

    }

    public function deletedSuccessfully($medicalCenter)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterMessage::$medicalCenterDeletedSuccessfully,
            'data' => [
                'medicalCenter' => $medicalCenter,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterMessage::$medicalCenterRestoredSuccessfully,
        ]);
    }
    public function enabledSuccessfully($medicalCenter)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterMessage::$medicalCenterEnabledSuccessfully,
            'data' => [
                'medicalCenter' => $medicalCenter,
            ],
        ]);

    }
    public function disabledSuccessfully($medicalCenter)
    {
        return response()->json([
            'status' => 'success',
            'message' => MedicalCenterMessage::$medicalCenterDisabledSuccessfully,
            'data' => [
                'medicalCenter' => $medicalCenter,
            ],
        ]);

    }


}
