<?php

namespace Appointment\Http\Controllers;

use App\Http\Controllers\Controller;
use Appointment\Repository\Contracts\AppointmentRepository;

class BaseAppointmentController extends Controller
{
    public $appointmentRepository;

    public function __construct()
    {
        $this->appointmentRepository = resolve(AppointmentRepository::class);
    }
}
