<?php
namespace Auth\Http\Controllers\User;
use Auth\Service\AuthResponseInterface;

class UserLogoutController
{

    public $response;

    public function __construct()
    {
        auth()->setDefaultDriver('api');
        $this->response = app(AuthResponseInterface::class);
    }

    public function logout()
    {
        // Logout User
        auth()->logout();
        $this->response->Logout();
    }
}