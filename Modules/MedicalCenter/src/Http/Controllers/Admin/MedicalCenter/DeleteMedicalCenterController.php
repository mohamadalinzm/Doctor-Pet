<?php

namespace MedicalCenter\Http\Controllers\Admin\MedicalCenter;

use MedicalCenter\Facades\MedicalCenterResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Models\MedicalCenter;
use function request;

class DeleteMedicalCenterController extends BaseMedicalCenterController
{

    public function destroy(MedicalCenter $medicalCenter)
    {
        //delete product
        $this->medicalCenterRepository->delete($medicalCenter);

        // Response
        return MedicalCenterResponderFacade::deletedSuccessfully($medicalCenter);
    }
}
