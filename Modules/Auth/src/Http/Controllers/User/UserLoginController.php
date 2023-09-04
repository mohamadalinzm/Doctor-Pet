<?php

namespace Auth\Http\Controllers\User;

use Auth\Http\Controllers\AuthBaseController;
use Auth\OTP\Contract\OTP;

class UserLoginController extends AuthBaseController
{
    public function login(OTP $OTP)
    {

        // Check User Not Logged In
        $isUserLoggedIn = $this->driver->isUserLoggedIn();
        if ($isUserLoggedIn) {
            $this->response->UserLoggedInAlready();
        }

        // Initializing Data
        $mobile = request()->input('mobile');


        // Validate Request Data
        $this->validation->login(request()->all(),true);


        // Check Is Any Admin User With This Mobile Existed
        $this->driver->isUserExisted($mobile);


        // Send OTP
        $this->driver->send($OTP,$mobile);


        // Send Response(OTP Sent)
        return $this->response->OTPSendSuccess($mobile);
    }
}
