<?php

namespace User\Service\Response\Resource;

use Illuminate\Http\JsonResponse;
use User\Service\Transformer\Resource\UserListResource;
use User\Support\Message\UserMessage;

class AdminUserResponse
{

    public function UserDeletedSuccess(): JsonResponse
    {
        response()->json([
            'message' => UserMessage::$successDelete,
            'type' => 'success',
        ])->throwResponse();
    }


    public function UserUpdatedSuccess(): JsonResponse
    {
        response()->json([
            'type' => 'success',
            'message' => UserMessage::$successToUpdateUser,
        ])->throwResponse();
    }


    public function UserNotFound(): JsonResponse
    {
        response()->json([
            'type' => 'error',
            'message' => UserMessage::$userNotFound,
        ])->throwResponse();
    }


    public function UserList($users)
    {
        return UserListResource::collection($users);
    }


    public function UserValidationFailed($errors): JsonResponse
    {
        response()->json([
            'errors' => $errors,
        ])->throwResponse();
    }


    public function UserBanSuccess(): JsonResponse
    {
        response()->json([
            'message' => UserMessage::$successToBanUser,
            'type' => 'success',
        ])->throwResponse();
    }


    public function UserStoredSuccess(): JsonResponse
    {
        response()->json([
            'type' => 'success',
            'message' => UserMessage::$successToSaveUser,
        ])->throwResponse();
    }


    public function UserShow($User): JsonResponse
    {
        response()->json([
            'type' => 'success',
            'data' => $User,
        ])->throwResponse();
    }

}
