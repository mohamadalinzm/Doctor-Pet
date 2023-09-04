<?php

namespace Auth\Foundation\Driver;

use Auth\Service\AuthResponseInterface;
use Auth\Service\Repository\AuthRepository;
use User\Service\Repository\UserRepositoryService;

class AuthUserDriver
{
    protected AuthRepository $AuthRepository;

    protected AuthResponseInterface $response;

    public function __construct()
    {
        $this->AuthRepository = app(AuthRepository::class);
        $this->response = app(AuthResponseInterface::class);
    }

    public function isUserExisted($mobile)
    {
        $UserRepository = (new UserRepositoryService);
        $user = $UserRepository->fetchUserByMobile($mobile);
        if (! $user) {
            $this->response->UserNotFound();
        }

        return $user;
    }

    public function isUserAlreadyExisted($mobile)
    {
        $UserRepository = (new UserRepositoryService);
        $user = $UserRepository->fetchUserByMobile($mobile);
        if ($user) {
            $this->response->UserAlreadyExisted();
        }

        return true;
    }

    public function send($OTP, $mobile)
    {
        $OTPProcess = $OTP->startSendOTPProcess($mobile);;
        if (! $OTPProcess->sendIsSuccess()) {
            $this->response->OTPSendFailed($OTPProcess->getMessage());
        }

        return true;
    }

    public function verify($mobile, $otp, $OTP)
    {
        $verifyOTPProcess = $OTP->startVerifyOTPProcess($mobile, $otp);
        if (! $verifyOTPProcess->verifyIsSuccess()) {
            $this->response->OTPValidationFailed($verifyOTPProcess->getMessage());
        }

        return true;
    }

    public function isUserLoggedIn()
    {
        if (auth()->check()) {
            return true;
        }

        return false;
    }

    public function create($data)
    {
        $UserRepository = (new UserRepositoryService);
        return $UserRepository->create($data);
    }

}