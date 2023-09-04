<?php

namespace Auth\Http\Controllers\Admin;

use Auth\Http\Controllers\AuthBaseController;
use Auth\OTP\Contract\OTP;
use Illuminate\Support\Facades\Auth;

class AdminVerifyOTPController extends AuthBaseController
{

    public function verify(OTP $OTP)
    {
        $this->middleware('guest:api');

        // Validate Mobile
        $otp = request()->otp;
        $data = ['otp' => $otp];

        // Validate OTP
        $this->validation->otp($data);

        // Get Mobile Number
        $mobile = request()->mobile;

        // Check Is Any Admin User With This Mobile Existed
        $user = $this->driver->isUserExisted($mobile);

        // Check Is User Admin
        $this->driver->isUserAdmin($user);


        // Verify OTP
        $this->driver->verify($mobile,$otp,$OTP);


        // Login Admin
        Auth::login($user);

        // Redirect to Admin Dashboard
        $this->response->VerifiedSuccessfully();
    }
}
