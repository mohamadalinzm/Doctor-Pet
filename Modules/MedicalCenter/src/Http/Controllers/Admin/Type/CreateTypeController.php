<?php

namespace MedicalCenter\Http\Controllers\Admin\Type;

use MedicalCenter\Facades\MedicalCenterTypeResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Http\Validator\MedicalCenterTypeValidator;
use function request;

class CreateTypeController extends BaseMedicalCenterController
{

    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = MedicalCenterTypeValidator::check($data);
        if ($validator->fails()) {
            return MedicalCenterTypeResponderFacade::validationFailed($validator->messages()->toArray());
        }


        // Store
        $medicalCenterType = $this->medicalCenterTypeRepository->store($data);

        // Response
        return MedicalCenterTypeResponderFacade::storedSuccessfully($medicalCenterType);
    }
}
