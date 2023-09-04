<?php

namespace MedicalCenter\Http\Controllers;

use App\Http\Controllers\Controller;
use MedicalCenter\Repository\Contracts\MedicalCenterRepository;
use MedicalCenter\Repository\Contracts\MedicalCenterTypeRepository;
use MedicalCenter\Repository\Contracts\ServiceRepository;

class BaseMedicalCenterController extends Controller
{
    public $medicalCenterRepository;
    public $medicalCenterTypeRepository;
    public $serviceRepository;
    public function __construct()
    {
        $this->medicalCenterRepository = resolve(MedicalCenterRepository::class);
        $this->medicalCenterTypeRepository = resolve(MedicalCenterTypeRepository::class);
        $this->serviceRepository = resolve(ServiceRepository::class);
    }
}
