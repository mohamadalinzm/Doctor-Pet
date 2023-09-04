<?php

namespace Shift\Traits;

use Illuminate\Http\JsonResponse;
use Shift\Service\Transformers\Resource\ShiftShowResource;
use Shift\Support\Message\ShiftMessage;

trait ShiftResponsesTrait
{

    public function ShiftDeletedSuccess(): JsonResponse
    {
        response()->json([
            'message' => ShiftMessage::$SuccessInDelete,
            'type' => 'success',
        ])->throwResponse();
    }


    public function ShiftUpdatedSuccess($Shift)
    {
        response()->json([
            'type' => 'success',
            'message' => ShiftMessage::$SuccessInUpdate,
            'data' => ShiftShowResource::make($Shift)
        ])->throwResponse();
    }

    public function ShiftNotFound()
    {
        response()->json([
            'type' => 'error',
            'message' => ShiftMessage::$ShiftNotFound,
        ])->throwResponse();
    }


    public function ShiftValidationFailed($errors)
    {
        response()->json([
            'errors' => $errors,
        ])->throwResponse();
    }


    public function ShiftStoredSuccess($Shift)
    {
        response()->json([
            'type' => 'success',
            'message' => ShiftMessage::$SuccessInStore,
            'data' => ShiftShowResource::make($Shift)
        ])->throwResponse();
    }

}