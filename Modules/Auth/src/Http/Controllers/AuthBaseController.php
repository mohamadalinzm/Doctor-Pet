<?php

namespace Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Service\Api;
use Auth\AuthInterface;
use Auth\Foundation\Factory\AuthFactory;
use Auth\Service\AuthEventInterface;
use Auth\Service\AuthTransformerInterface;
use Auth\Service\AuthValidationInterface;
use Auth\Service\AuthViewInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Auth\Service\AuthResponseInterface;

class AuthBaseController extends Api
{

    public $driver;

    public Authenticatable $user;

    public AuthValidationInterface $validation;

    public AuthTransformerInterface $transformer;

    public AuthResponseInterface $response;

    public AuthEventInterface $event;

    public string $guard;

    public function __construct()
    {
        // 1 - Set Api Actions
        $this->api();

        // 2 - Generate Driver
        $this->driver = AuthFactory::factory($this->getPrefix(3));

        // 5 - Installing Services
        $this->setup();
    }

    protected function setup()
    {
        $this->validation = app(AuthValidationInterface::class);
        $this->event = app(AuthEventInterface::class);
        $this->transformer = app(AuthTransformerInterface::class);
        $this->response = app(AuthResponseInterface::class);
    }
}
