<?php

namespace Appointment\Http\Controller;

use Appointment\Http\Controllers\BaseShiftController;
use Appointment\Facades\ShiftResponderFacade;
use Appointment\Http\Validator\ShiftValidator;
use Appointment\Models\Shift;
use Morilog\Jalali\Jalalian;

class ShiftController extends BaseShiftController
{

    public function index()
    {
        $shifts = collect();
        $shiftsListCount=0;

        if (request()->wantsJson()) {
            $shifts = $this->shiftRepository->index(request('searchterm'));
        }
        return ShiftResponderFacade::list($shifts,$shiftsListCount);
    }


    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = ShiftValidator::check($data);
        if ($validator->fails()) {
            return ShiftResponderFacade::validationFailed($validator->messages()->toArray());
        }

        $data['date'] = Jalalian::forge($data['week_day'])->format('Y-m-d');
        $data['start-time'] = Jalalian::forge($data['start-time'])->format('H:i');
        $data['end-time'] = Jalalian::forge($data['end-time'])->format('H:i');

        // Store
        $shift = $this->shiftRepository->store($data);

        // Response
        return ShiftResponderFacade::storedSuccessfully($shift);
    }

    public function update(Shift $shift)
    {
        $data = request()->all();

        // Validate Request
        $validator = ShiftValidator::check($data);
        if ($validator->fails()) {
            return ShiftResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->shiftRepository->update($shift,$data);

        // Response
        return ShiftResponderFacade::updatedSuccessfully($shift);
    }


    public function destroy(Shift $shift)
    {
        //delete product
        $this->shiftRepository->delete($shift);

        // Response
        return ShiftResponderFacade::deletedSuccessfully($shift);
    }

}
