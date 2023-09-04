<?php

namespace MedicalCenter\Http\Controllers\Admin\MedicalCenter;

use MedicalCenter\Facades\MedicalCenterResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Http\Validator\MedicalCenterValidator;
use MedicalCenter\Models\MedicalCenter;
use function request;

class UpdateMedicalCenterController extends BaseMedicalCenterController
{

    public function update(MedicalCenter $medicalCenter)
    {
        $data = request()->all();

        // Validate Request
        $validator = MedicalCenterValidator::check($data);
        if ($validator->fails()) {
            return MedicalCenterResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->medicalCenterRepository->update($medicalCenter,$data);

        // Response
        return MedicalCenterResponderFacade::updatedSuccessfully($medicalCenter);
    }
}
