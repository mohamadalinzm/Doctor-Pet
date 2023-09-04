<?php

namespace Appointment\Repository;

use Appointment\Models\Appointment;
use Appointment\Models\Shift;
use Appointment\Repository\Contracts\ShiftRepository;
use Morilog\Jalali\Jalalian;

class EloquentShiftRepository implements ShiftRepository
{


    public function show(Shift $shift)
    {
        return $shift->select(['id','shift_number','type','title','message','status'])
            ->with(['user','comments'])
            ->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function index($searchTerm = '', $active = null)
    {
        return Shift::select(['id','shift_number','type','title','status'])
            ->with(['user'])
            ->search($searchTerm)->get()
            ->each(function ($item) {
                $item->date = Jalalian::forge(strtotime($item->created_at))->format('Y/m/d ');
            });
    }


    public function delete(Shift $shift)
    {
        $shift->delete();
    }

    public function store($data)
    {

        Shift::query()->create($data);

        for ($i = 0 ; $i < $data['qty'] ; $i++)
        {
            Appointment::query()->create($data);
            $data['start-time'] = Jalalian::forge($data['start-time'])->addMinutes($data['session_duration'])->format('H:i');
        }
        Shift::query()->create($data);
    }

    public function update(Shift $shift, $data)
    {

        $shift->update($data);

        return $shift;
    }

}
