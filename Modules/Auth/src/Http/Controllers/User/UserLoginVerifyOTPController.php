<?php

namespace Auth\Http\Controllers\User;

use Auth\Http\Controllers\AuthBaseController;
use Auth\OTP\Contract\OTP;

class UserLoginVerifyOTPController extends AuthBaseController
{
    public function verify(OTP $OTP)
    {
        // Check User Not Logged In
        $isUserLoggedIn = $this->driver->isUserLoggedIn();
        if ($isUserLoggedIn) {
            $this->response->UserLoggedInAlready();
        }

        // Initializing Data
        $otp = request()->otp;
        $mobile = request()->mobile;
        $data = ['mobile' => $mobile];

        // Validate Mobile
        $this->validation->mobile($data);

        // Validate OTP
        $this->validation->otp(['otp' => $otp]);

        // Check Is User With This Mobile Existed
        $user = $this->driver->isUserExisted($mobile);

        // Verify OTP
        $this->driver->verify($mobile,$otp,$OTP);

        // Login Admin
        auth()->login($user);

        // Redirect to Admin Dashboard
        return $this->response->LoginSuccess(auth()->user());
    }
}
