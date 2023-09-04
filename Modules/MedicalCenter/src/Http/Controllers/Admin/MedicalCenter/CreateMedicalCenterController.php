<?php

namespace MedicalCenter\Http\Controllers\Admin\MedicalCenter;

use MedicalCenter\Facades\MedicalCenterResponderFacade;
use MedicalCenter\Facades\ServiceResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Http\Validator\MedicalCenterValidator;
use MedicalCenter\Support\MedicalCenter\MedicalCenterSupport;
use MedicalCenter\Support\MedicalCenter\ServiceSupport;
use function request;

class CreateMedicalCenterController extends BaseMedicalCenterController
{

    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = MedicalCenterValidator::check($data);
        if ($validator->fails()) {
            return ServiceResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Store
        $medicalCenter = $this->medicalCenterRepository->store($data);

        // Response
        return MedicalCenterResponderFacade::storedSuccessfully($medicalCenter);
    }
}
