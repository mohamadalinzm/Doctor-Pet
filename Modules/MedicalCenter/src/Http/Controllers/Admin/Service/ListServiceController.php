<?php

namespace MedicalCenter\Http\Controllers\Admin\Service;

use MedicalCenter\Facades\ServiceResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use function collect;
use function request;

class ListServiceController extends BaseMedicalCenterController
{

    public function index()
    {
        $services = collect();
        $servicesListCount=0;

        if (request()->wantsJson()) {
            $services = $this->serviceRepository->index(request('searchterm'));
        }
        return ServiceResponderFacade::adminMedicalCenterList($services,$servicesListCount);
    }
}
