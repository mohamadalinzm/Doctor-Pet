<?php

namespace MedicalCenter\Http\Controllers\Admin\Service;

use MedicalCenter\Facades\ServiceResponderFacade;
use MedicalCenter\Http\Controllers\BaseMedicalCenterController;
use MedicalCenter\Http\Validator\ServiceValidator;
use function request;

class CreateServiceController extends BaseMedicalCenterController
{

    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = ServiceValidator::check($data);
        if ($validator->fails()) {
            return ServiceResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Store
        $service = $this->serviceRepository->store($data);

        // Response
        return ServiceResponderFacade::storedSuccessfully($service);
    }
}
