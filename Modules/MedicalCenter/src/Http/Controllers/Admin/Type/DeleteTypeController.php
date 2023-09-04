<?php

namespace MedicalCenter\Http\Controllers\Admin\Type;

use MedicalCenter\Facades\MedicalCenterTypeResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Models\MedicalCenterType;
use function request;

class DeleteTypeController extends BaseMedicalCenterController
{

    public function destroy(MedicalCenterType $type)
    {
        //delete product
        $this->medicalCenterTypeRepository->delete($type);

        // Response
        return MedicalCenterTypeResponderFacade::deletedSuccessfully($type);
    }
}
