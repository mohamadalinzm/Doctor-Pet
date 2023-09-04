<?php

namespace MedicalCenter\Http\Controllers\Admin\Type;

use MedicalCenter\Facades\MedicalCenterResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use function collect;
use function request;

class ListTypeController extends BaseMedicalCenterController
{

    public function index()
    {
        $medicalCenterTypes = collect();
        $medicalCenterTypesListCount=0;

        if (request()->wantsJson()) {
            $medicalCenterTypes = $this->medicalCenterTypeRepository->index(request('searchterm'));
        }
        return MedicalCenterResponderFacade::adminMedicalCenterList($medicalCenterTypes,$medicalCenterTypesListCount);
    }
}
