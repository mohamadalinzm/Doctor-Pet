<?php

namespace MedicalCenter\Http\Controllers\Admin\Service;

use MedicalCenter\Facades\ServiceResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Http\Validator\ServiceValidator;
use MedicalCenter\Models\Service;
use function request;

class UpdateServiceController extends BaseMedicalCenterController
{

    public function update(Service $service)
    {
        $data = request()->all();

        // Validate Request
        $validator = ServiceValidator::check($data);
        if ($validator->fails()) {
            return ServiceResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->serviceRepository->update($service,$data);

        // Response
        return ServiceResponderFacade::updatedSuccessfully($service);
    }
}
