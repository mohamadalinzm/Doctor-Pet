<?php

namespace MedicalCenter\Responder\Service;

use MedicalCenter\Http\Resources\ServiceResource;
use MedicalCenter\Support\Service\ServiceMessage;
use Symfony\Component\HttpFoundation\Response;
use function response;

class ServiceApiResponder
{
    public function list($services)
    {
        return ServiceResource::collection($services);
    }

    public function adminMedicalCenterList($services)
    {
        return ServiceResource::collection($services);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($service)
    {
        return response()->json([
            'status' => 'success',
            'message' => ServiceMessage::$serviceSavedSuccessfully,
            'data' => [
                'service' => $service,
            ],
        ]);

    }

    public function updatedSuccessfully($service)
    {
        return response()->json([
            'status' => 'success',
            'message' => ServiceMessage::$serviceUpdatedSuccessfully,
            'data' => [
                'service' => $service,
            ],
        ]);

    }

    public function deletedSuccessfully($service)
    {
        return response()->json([
            'status' => 'success',
            'message' => ServiceMessage::$serviceDeletedSuccessfully,
            'data' => [
                'service' => $service,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => ServiceMessage::$serviceRestoredSuccessfully,
        ]);
    }
    public function enabledSuccessfully($service)
    {
        return response()->json([
            'status' => 'success',
            'message' => ServiceMessage::$serviceEnabledSuccessfully,
            'data' => [
                'service' => $service,
            ],
        ]);

    }
    public function disabledSuccessfully($service)
    {
        return response()->json([
            'status' => 'success',
            'message' => ServiceMessage::$serviceDisabledSuccessfully,
            'data' => [
                'service' => $service,
            ],
        ]);

    }


}
