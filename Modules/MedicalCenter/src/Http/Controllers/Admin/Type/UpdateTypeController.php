<?php

namespace MedicalCenter\Http\Controllers\Admin\Type;

use MedicalCenter\Facades\MedicalCenterTypeResponderFacade;
use MedicalCenter\Facades\ServiceResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Http\Validator\MedicalCenterTypeValidator;
use MedicalCenter\Models\MedicalCenterType;
use function request;

class UpdateTypeController extends BaseMedicalCenterController
{

    public function update(MedicalCenterType $type)
    {
        $data = request()->all();

        // Validate Request
        $validator = MedicalCenterTypeValidator::check($data);
        if ($validator->fails()) {
            return MedicalCenterTypeResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->medicalCenterTypeRepository->update($type,$data);

        // Response
        return ServiceResponderFacade::updatedSuccessfully($type);
    }
}
