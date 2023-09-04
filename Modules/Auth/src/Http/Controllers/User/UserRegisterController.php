<?php

namespace Auth\Http\Controllers\User;

use Auth\Http\Controllers\AuthBaseController;
use Auth\OTP\Contract\OTP;

class UserRegisterController extends AuthBaseController
{

    public function register(OTP $OTP)
    {
        // Initializing Data
        $this->middleware('guest');

        $mobile = request()->mobile;
        $terms = request()->terms;
        $data = ['mobile' => $mobile , 'terms' => $terms];

        // Validate Data
        $this->validation->register($data);

        // Check User Not Exists
        $this->driver->isUserAlreadyExisted($mobile);

       // Send OTP
        $this->driver->send($OTP,$mobile);

        // Return Response
        $this->response->RegisterSuccessfullySend();
    }
}
