<?php

namespace Auth\Http\Controllers\Admin;

use Auth\Http\Controllers\AuthBaseController;
use Auth\OTP\Contract\OTP;

// First We Initializing All Data For Usage

class AdminLoginController extends AuthBaseController
{

    public function login(OTP $OTP)
    {

        // Initializing
        $this->middleware('guest:api');


        // Get Mobile Request
        $mobile = request()->mobile;
        $data = ['mobile' => $mobile];

        // Validate Inputs
        $this->validation->login($data,true);


        // Check Is Any Admin User With This Mobile Existed
        $user = $this->driver->isUserExisted($mobile);

        // Check Is User Admin
        $this->driver->isUserAdmin($user);

        // Send OTP
        $this->driver->send($OTP,$mobile);

        // Event Send OTP
        $this->event->login($user);

        // Send OTP Successes
        $this->response->OTPSendSuccess($mobile);
    }
}
