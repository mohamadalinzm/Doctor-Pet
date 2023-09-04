<?php

namespace Appointment\Http\Controller;


use Appointment\Http\Controllers\BaseAppointmentController;
use Appointment\Facades\AppointmentResponderFacade;
use Appointment\Http\Validator\AppointmentValidator;
use Appointment\Models\Appointment;
use Morilog\Jalali\Jalalian;

class AppointmentController extends BaseAppointmentController
{

    public function index()
    {
        $appointments = collect();
        $appointmentsListCount=0;

        if (request()->wantsJson()) {
            $appointments = $this->appointmentRepository->index(request('searchterm'));
        }
        return AppointmentResponderFacade::list($appointments,$appointmentsListCount);
    }


    public function store()
    {
        $data = request()->all();

        // Validate Request
        $validator = AppointmentValidator::check($data);
        if ($validator->fails()) {
            return AppointmentResponderFacade::validationFailed($validator->messages()->toArray());
        }

        $data['date'] = Jalalian::forge($data['week_day'])->format('Y-m-d');
        $data['start-time'] = Jalalian::forge($data['start-time'])->format('H:i');
        $data['end-time'] = Jalalian::forge($data['end-time'])->format('H:i');

        // Store
        $appointment = $this->appointmentRepository->store($data);

        // Response
        return AppointmentResponderFacade::storedSuccessfully($appointment);
    }

    public function update(Appointment $appointment)
    {
        $data = request()->all();

        // Validate Request
        $validator = AppointmentValidator::check($data);
        if ($validator->fails()) {
            return AppointmentResponderFacade::validationFailed($validator->messages()->toArray());
        }

        // Update
        $this->appointmentRepository->update($appointment,$data);

        // Response
        return AppointmentResponderFacade::updatedSuccessfully($appointment);
    }


    public function destroy(Appointment $appointment)
    {
        //delete product
        $this->appointmentRepository->delete($appointment);

        // Response
        return AppointmentResponderFacade::deletedSuccessfully($appointment);
    }

}
