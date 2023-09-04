<?php

namespace Auth\Http\Controllers\Admin;

use App\Service\Api;
use Auth\Http\Controllers\AuthBaseController;
use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends AuthBaseController
{
    public function logout()
    {
        // Check Is User Logged In
        $this->middleware('jwt.auth');

        // Check Is LoggedIn User Admin
        $this->driver->isUserAdmin(auth()->user());

        // If An Admin User LoggedIn Then Logout Him
        auth()->logout();

        // Return Response For User
        return $this->response->Logout();
    }
}
