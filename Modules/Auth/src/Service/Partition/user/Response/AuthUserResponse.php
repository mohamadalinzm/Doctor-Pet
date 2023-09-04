<?php

namespace Auth\Service\Partition\user\Response;

use Auth\Service\AuthResponseInterface;
use Auth\Support\AuthMessage;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthUserResponse implements AuthResponseInterface
{
    public function ValidationFailed(array $messages): JsonResponse
    {
        response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY)->throwResponse();
    }


    public function OTPSendFailed($messages): JsonResponse
    {
         response()->json([
            'status' => 'error',
            'message' => $messages,
        ])->throwResponse();
    }


    public function OTPValidationFailed($message): JsonResponse
    {
        response()->json([
            'status' => 'error',
            'message' => $message,
        ], Response::HTTP_UNPROCESSABLE_ENTITY)->throwResponse();
    }


    public function loginUserNotFound()
    {
         response()->json([
            'status' => 'error',
            'message' => AuthMessage::$userNotFound,
        ], Response::HTTP_NOT_FOUND)->throwResponse();
    }



    public function RegisterValidationFail($messages): JsonResponse
    {
        response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY)->throwResponse();
    }

    public function RegisterUserExist(): JsonResponse
    {
        response()->json([
            'status' => 'error',
            'message' => AuthMessage::$userExist,
        ], Response::HTTP_UNPROCESSABLE_ENTITY)->throwResponse();
    }

    public function RegisterSuccess($token)
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$sentOTPToYourMobileSuccessfully,
            'user' => auth()->user(),
            'token' => $token,
            'token_type' => 'bearer',
            'data' => [
                'mobile' => request()->mobile,
                'country_code' => request()->country_code,
                'role' => request()->role,
                'name' => request()->name,
            ],
        ])->throwResponse();;
    }

    public function TokenInvalid($users): JsonResponse
    {
        response()->json([
            'status' => 'error',
            'message' => AuthMessage::$tokenInvalid,
        ], Response::HTTP_UNAUTHORIZED)->throwResponse();
    }



    public function Logout(): JsonResponse
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$logoutSuccess,
        ])->throwResponse();
    }

    public function VerifiedSuccessfully(): JsonResponse
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$OTPVerifiedSuccessfully,
            'data' => [
                'token' => request()->mobile,
            ],
        ])->throwResponse();
    }

    public function OTPSendSuccess($mobile): JsonResponse
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$sentOTPToYourMobileSuccessfully,
            'data' => [
                'mobile' => request()->mobile,
            ],
        ])->throwResponse();
    }

    public function AuthValidationFailed($message): JsonResponse
    {
        response()->json([
            'status' => 'success',
            'message' => $message,
        ])->throwResponse();
    }

    public function UserNotFound(): JsonResponse
    {
         response()->json([
            'status' => 'error',
            'message' => AuthMessage::$userNotFound,
        ], Response::HTTP_NOT_FOUND)->throwResponse();
    }

    public function UserExisted()
    {
        // TODO: Implement UserExisted() method.
    }

    public function LoginFail($messages): JsonResponse
    {
        response()->json([
            'status' => 'error',
            'message' => AuthMessage::$loginFailed,
            'errors' => $messages,
            'data' => [
                'mobile' => request()->mobile,
            ],
        ])->throwResponse();
    }

    public function LoginSuccess($token): JsonResponse
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$loginSuccess,
            'user' => auth()->user(),
            'token' => $token,
            'token_type' => 'bearer',
        ])->throwResponse();
    }

    public function TokenSuccessfullyRefresh($user,$token): JsonResponse
    {
        $data = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer',
        ];

        response()->json(['message' => 'ok', 'status' => true, 'data' => $data],200)->throwResponse();
    }

    public function UserNotLoggedIn()
    {
        response()->json([
            'status' => 'error',
            'message' => AuthMessage::$UserNotLoggedIn,
        ])->throwResponse();
    }

    public function UserLoggedInAlready()
    {
        response()->json([
            'status' => 'error',
            'message' => AuthMessage::$UserLoggedInAlready,
        ])->throwResponse();
    }

    public function UserAlreadyExisted()
    {
        response()->json([
            'status' => 'error',
            'message' => AuthMessage::$UserAlreadyExisted,
        ])->throwResponse();
    }

    public function RegisterSuccessfullySend()
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$RegisterSuccessfullySend,
        ])->throwResponse();
    }

    public function UserIsNotAdmin()
    {
        response()->json([
            'status' => 'success',
            'message' => AuthMessage::$UserIsNotAdmin,
        ])->throwResponse();
    }
}
