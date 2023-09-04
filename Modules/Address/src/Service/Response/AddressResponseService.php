<?php

namespace Address\Service\Response;

use Address\Foundation\Service\AddressService;
use Address\Service\AddressResponseInterface;
use Address\Support\Message\AddressMessage;

class AddressResponseService implements AddressResponseInterface
{

    public function AddressAlreadyExisted()
    {
        response()->json([
            'message' => AddressMessage::$AddressAlreadyExisted,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressCantDeletedByYou()
    {
        response()->json([
            'message' => AddressMessage::$AddressCantDeletedByYou,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressDeleted()
    {
        response()->json([
            'message' => AddressMessage::$AddressDeleted,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AddressValidationFailed($errors)
    {
        response()->json([
            'message' => AddressMessage::$AddressValidationFailed,
            'type' => 'error',
            'errors' => $errors
        ])->throwResponse();
    }

    public function AddressStored()
    {
        response()->json([
            'message' => AddressMessage::$AddressStored,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AddressUpdated()
    {
        response()->json([
            'message' => AddressMessage::$AddressUpdated,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AddressSetDefault()
    {
        response()->json([
            'message' => AddressMessage::$AddressSetDefault,
            'type' => 'success',
        ])->throwResponse();
    }

    public function AddressNotFound()
    {
        response()->json([
            'message' => AddressMessage::$AddressNotFound,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressIsNotActive()
    {
        response()->json([
            'message' => AddressMessage::$AddressIsNotActive,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressOverLimitation()
    {
        response()->json([
            'message' => AddressMessage::$AddressOverLimitation,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressCantAlterByThisUser()
    {
        response()->json([
            'message' => AddressMessage::$AddressCantAlterByThisUser,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressDefaultIsAlreadyWasInThisStatus()
    {
        response()->json([
            'message' => AddressMessage::$AddressDefaultIsAlreadyWasInThisStatus,
            'type' => 'error',
        ])->throwResponse();
    }

    public function AddressCantSeeByYou()
    {
        response()->json([
            'message' => AddressMessage::$AddressCantSeeByYou,
            'type' => 'error',
        ])->throwResponse();
    }
}
