<?php

namespace MedicalCenter\Http\Controllers\Admin\MedicalCenter;

use MedicalCenter\Facades\MedicalCenterResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use function collect;
use function request;

class ListMedicalCenterController extends BaseMedicalCenterController
{

    public function index()
    {
        $medicalCenters = collect();
        $medicalCentersListCount=0;

        if (request()->wantsJson()) {
            $medicalCenters = $this->medicalCenterRepository->index(request('searchterm'));
        }
        return MedicalCenterResponderFacade::adminMedicalCenterList($medicalCenters,$medicalCentersListCount);
    }
}
