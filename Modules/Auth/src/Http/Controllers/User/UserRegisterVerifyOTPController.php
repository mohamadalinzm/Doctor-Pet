<?php

namespace Auth\Http\Controllers\User;

use Auth\Http\Controllers\AuthBaseController;
use Auth\OTP\Contract\OTP;
use Spatie\Permission\Models\Role;

class UserRegisterVerifyOTPController extends AuthBaseController
{

    public function registerVerifyOTP(OTP $OTP)
    {

        // Check User Not Logged In
        $isUserLoggedIn = $this->driver->isUserLoggedIn();
        if ($isUserLoggedIn) {
            $this->response->UserLoggedInAlready();
        }

        // Initializing Data
        $mobile = request()->input('mobile');
        $terms = request()->input('terms');
        $otp = request()->input('otp');
        $data = ['mobile' => $mobile , 'terms' => $terms];

        // Validate Data
        $this->validation->register($data);

        // Validate OTP
        $this->validation->otp(['otp' => $otp]);

        // Check User Not Exists
        $this->driver->isUserAlreadyExisted($mobile);


        // Verify OTP
        $this->driver->verify($mobile,$otp,$OTP);


        // Create User
        $user = $this->driver->create(['mobile' => $mobile]);
<<<<<<< HEAD

        // fetch role
        $role = Role::findByName('costumer');

        // attach role
        $user->assignRole($role);

=======
>>>>>>> 256380e0e6f9d7533466e3d2d5df4c1497b6d265

        // Login User
        auth()->login($user);


        // run UserRegisterEvent
        $user->assignRole('customer');


        // Return Response
        $this->response->RegisterSuccess(auth()->user());
    }
}
