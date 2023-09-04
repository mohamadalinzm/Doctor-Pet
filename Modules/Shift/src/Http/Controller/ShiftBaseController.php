<?php

namespace Shift\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Shift\Foundation\Factory\ShiftFactory;

class ShiftBaseController extends Controller
{
    public $service;

    public function __construct()
    {
        // 1 - Generate Between Api & Web
        auth()->setDefaultDriver('api');

        // 2 - Get Driver & Prefix
        $prefix = request()->route()->getPrefix();

        // 3 - Generate Driver
        $service = ShiftFactory::factory($prefix);
        if (! $service) {
            throw new AuthenticationException('Not Authorized !');
        }


        $this->service = $service;
    }

}


