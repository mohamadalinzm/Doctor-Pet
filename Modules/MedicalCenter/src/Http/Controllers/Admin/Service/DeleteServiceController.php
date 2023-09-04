<?php

namespace MedicalCenter\Http\Controllers\Admin\Service;

use MedicalCenter\Facades\ServiceResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Models\Service;
use function request;

class DeleteServiceController extends BaseMedicalCenterController
{

    public function destroy(Service $service)
    {
        //delete product
        $this->serviceRepository->delete($service);

        // Response
        return ServiceResponderFacade::deletedSuccessfully($service);
    }
}
