<?php

namespace Appointment\Http\Controllers;

use App\Http\Controllers\Controller;
use Appointment\Repository\Contracts\ShiftRepository;

class BaseShiftController extends Controller
{
    public $shiftRepository;

    public function __construct()
    {
        $this->shiftRepository = resolve(ShiftRepository::class);
    }
}
