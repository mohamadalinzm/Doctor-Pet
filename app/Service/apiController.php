<?php

namespace App\Service;

use Address\Service\AddressValidationInterface;
use App\Http\Controllers\Controller;

abstract class apiController extends Controller
{
    protected function api()
    {
        $this->middleware('api');
        $this->middleware('jwt');
    }

}