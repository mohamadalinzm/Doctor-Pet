<?php

namespace Auth\Foundation\Driver;


use Auth\Service\AuthResponseInterface;
use Auth\Service\Repository\AuthRepository;

class AuthAdminDriver
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
        dd("asdadf");
    }

    public function isUserAdmin($user)
    {
        $getUserRole = $this->AuthRepository->getUserRole($user);
        if (!$getUserRole == 'admin'){
            $this->response->UserIsNotAdmin();
        }
    }

    public function send($OTP, $mobile): bool
    {
        $OTPProcess = $OTP->startSendOTPProcess($mobile);
        if (! $OTPProcess->sendIsSuccess()) {
            $this->response->OTPSendFailed();
            return AuthResponderFacade::OTPSendFailed($OTPProcess->getMessage());
        }

        return true;
    }

    public function verify($mobile, $otp, $OTP)
    {
        $verifyOTPProcess = $OTP->startVerifyOTPProcess($mobile, $otp);
        if ($verifyOTPProcess->verifyIsSuccess() == false) {
            return AuthResponderFacade::OTPVerificationFailed($verifyOTPProcess->getMessage());
        }

        return true;
    }
}