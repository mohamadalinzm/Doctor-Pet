<?php

namespace Pet\Service\Response;

use Pet\Foundation\Service\PetService;
use Pet\Service\PetResponseInterface;
use Pet\Support\Message\PetMessage;

class PetResponseService implements PetResponseInterface
{

    public function PetAlreadyExisted()
    {
        response()->json([
            'message' => PetMessage::$PetAlreadyExisted,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetCantDeletedByYou()
    {
        response()->json([
            'message' => PetMessage::$PetCantDeletedByYou,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetDeleted()
    {
        response()->json([
            'message' => PetMessage::$PetDeleted,
            'type' => 'success',
        ])->throwResponse();
    }

    public function PetValidationFailed($errors)
    {
        response()->json([
            'message' => PetMessage::$PetValidationFailed,
            'type' => 'error',
            'errors' => $errors
        ])->throwResponse();
    }

    public function PetStored()
    {
        response()->json([
            'message' => PetMessage::$PetStored,
            'type' => 'success',
        ])->throwResponse();
    }

    public function PetUpdated()
    {
        response()->json([
            'message' => PetMessage::$PetUpdated,
            'type' => 'success',
        ])->throwResponse();
    }

    public function PetSetDefault()
    {
        response()->json([
            'message' => PetMessage::$PetSetDefault,
            'type' => 'success',
        ])->throwResponse();
    }

    public function PetNotFound()
    {
        response()->json([
            'message' => PetMessage::$PetNotFound,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetIsNotActive()
    {
        response()->json([
            'message' => PetMessage::$PetIsNotActive,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetOverLimitation()
    {
        response()->json([
            'message' => PetMessage::$PetOverLimitation,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetCantAlterByThisUser()
    {
        response()->json([
            'message' => PetMessage::$PetCantAlterByThisUser,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetDefaultIsAlreadyWasInThisStatus()
    {
        response()->json([
            'message' => PetMessage::$PetDefaultIsAlreadyWasInThisStatus,
            'type' => 'error',
        ])->throwResponse();
    }

    public function PetCantSeeByYou()
    {
        response()->json([
            'message' => PetMessage::$PetCantSeeByYou,
            'type' => 'error',
        ])->throwResponse();
    }
}
