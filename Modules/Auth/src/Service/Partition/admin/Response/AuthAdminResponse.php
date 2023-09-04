<?php

namespace Auth\Service\Partition\admin\Response;

use Auth\Service\AuthResponseInterface;
use Auth\Support\AuthMessage;
use AuthResponseTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminResponse implements AuthResponseInterface
{
    use AuthResponseTrait;
}
