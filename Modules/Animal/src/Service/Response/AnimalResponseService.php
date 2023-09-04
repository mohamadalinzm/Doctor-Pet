<?php

namespace Animal\Service\Response;

use Animal\Foundation\Service\AnimalService;
use Animal\Service\AnimalResponseInterface;
use Animal\Support\Message\AnimalMessage;

class AnimalResponseService implements AnimalResponseInterface
{

    public function AnimalAlreadyExisted()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalAlreadyExisted,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalCantDeletedByYou()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalCantDeletedByYou,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalDeleted()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalDeleted,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AnimalValidationFailed($errors)
    {
        response()->json([
            'message' => AnimalMessage::$AnimalValidationFailed,
            'type' => 'error',
            'errors' => $errors
        ])->throwResponse();
    }

    public function AnimalStored()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalStored,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AnimalUpdated()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalUpdated,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AnimalSetDefault()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalSetDefault,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AnimalNotFound()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalNotFound,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalIsNotActive()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalIsNotActive,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalOverLimitation()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalOverLimitation,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalCantAlterByThisUser()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalCantAlterByThisUser,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalDefaultIsAlreadyWasInThisStatus()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalDefaultIsAlreadyWasInThisStatus,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AnimalCantSeeByYou()
    {
        response()->json([
            'message' => AnimalMessage::$AnimalCantSeeByYou,
            'type' => 'error',
        ])->throwResponse();
    }
}
