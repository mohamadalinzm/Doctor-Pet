<?php

namespace Auth\Service;

use User\Model\User;

interface AuthResponseInterface
{
    public function Logout();

    public function VerifiedSuccessfully();

    public function OTPSendSuccess($mobile);

    public function OTPSendFailed(array $messages);

    public function OTPValidationFailed($message);

    public function AuthValidationFailed($message);

    public function UserNotFound();

    public function UserExisted();

    public function LoginFail($messages);

    public function LoginUserNotFound();

    public function LoginSuccess($token);

    public function RegisterValidationFail($messages);

    public function RegisterUserExist();

    public function RegisterSuccess($token);

    public function RegisterSuccessfullySend();

    public function TokenInvalid($message);

    public function TokenSuccessfullyRefresh($user,$token);

    public function ValidationFailed(array $messages);

    public function UserNotLoggedIn();

    public function UserLoggedInAlready();

    public function UserAlreadyExisted();


}
