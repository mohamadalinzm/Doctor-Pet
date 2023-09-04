<?php

namespace Appointment\Repository;

use Appointment\Models\Appointment;
use Appointment\Repository\Contracts\AppointmentRepository;
use Morilog\Jalali\Jalalian;

class EloquentAppointmentRepository implements AppointmentRepository
{


    public function show(Appointment $appointment)
    {
        return $appointment->select(['id','appointment_number','type','title','message','status'])
            ->with(['user','comments'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return Appointment::select(['id','appointment_number','type','title','status'])
            ->with(['user'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(Appointment $appointment)
    {
        $appointment->delete();
    }

    public function store($data)
    {
        return Appointment::query()->create($data);
    }

    public function update(Appointment $appointment, $data)
    {

        $appointment->update($data);

        return $appointment;
    }

}
