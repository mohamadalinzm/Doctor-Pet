<?php

namespace Auth\Http\Controllers\User;

use Auth\Http\Controllers\AuthBaseController;
use Auth\Service\AuthResponseInterface;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use User\Service\Repository\UserRepositoryService;
use User\Service\UserRepositoryInterface;

class RefreshAuthTokenController
{

    public $response;

    public function __construct()
    {
        $this->response = app(AuthResponseInterface::class);
    }

    public function refresh()
    {

        auth()->setDefaultDriver('api');

        try {
            $token = auth()->refresh();
            return $this->response->TokenSuccessfullyRefresh($token,auth()->user());
        } catch (TokenInvalidException $e) {
            return $this->response->TokenInvalid($e->getMessage());
        }

    }
}
