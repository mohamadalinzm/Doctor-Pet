<?php

namespace Specialty\Http\Controllers\Admin;


use Specialty\Facades\SpecialtyResponderFacade;
use Specialty\Http\Controllers\BaseSpecialtyController;
use Specialty\Http\Validator\SpecialtyValidator;
use Specialty\Models\Specialty;
use function request;

class SpecialtyController extends BaseSpecialtyController
{

    public function index()
    {
        $specialties = collect();
        $specialtiesListCount=0;

        if (request()->wantsJson()) {
            $specialties = $this->specialtyRepository->index(request('searchterm'));
        }
        return SpecialtyResponderFacade::adminSpecialtyList($specialties,$specialtiesListCount);
    }

    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = SpecialtyValidator::check($data);
        if ($validator->fails()) {
            return SpecialtyResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Store
        $specialty = $this->specialtyRepository->store($data);

        // Response
        return SpecialtyResponderFacade::storedSuccessfully($specialty);
    }

    public function update(Specialty $specialty)
    {
        $data = request()->all();

        // Validate Request
        $validator = SpecialtyValidator::check($data);
        if ($validator->fails()) {
            return SpecialtyResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->specialtyRepository->update($specialty,$data);

        // Response
        return SpecialtyResponderFacade::updatedSuccessfully($specialty);
    }

    public function destroy(Specialty $specialty)
    {
        //delete product
        $this->specialtyRepository->delete($specialty);

        // Response
        return SpecialtyResponderFacade::deletedSuccessfully($specialty);
    }

}
