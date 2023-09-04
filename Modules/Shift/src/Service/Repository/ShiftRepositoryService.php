<?php

namespace Shift\Service\Repository;

use Ramsey\Uuid\Uuid;
use Shift\Model\Shift;
use Shift\Service\ShiftRepositoryInterface;

class ShiftRepositoryService implements ShiftRepositoryInterface
{

    public function fetch(int $id, array $appends = null, array $select = null)
    {
        $shift = Shift::query()->with($appends)->where('id', $id)->first();
        if (! $shift) {
            return false;
        }

        return $shift;
    }

    public function store(array $data)
    {
        return Shift::query()->create([
            'id' => Uuid::uuid4(),
            'doctor_id' => $data['doctor_id'],
            'day' => $data['day'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'session_duration' => $data['session_duration'],
            'creator_id' => auth()->user()->id,
        ]);
    }

    public function update(array $data, $shift)
    {
        $shift = $this->fetch($shift->id);

        return $shift->update([
            'doctor_id' => $data['doctor_id'],
            'day' => $data['day'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'session_duration' => $data['session_duration'],
        ]);
    }

    public function delete($shift)
    {
        $shift = $this->fetch($shift->id);

        return $shift->delete();
    }

    public function list(int $limit, array $appends , array $select = null)
    {
        return Shift::query()->with($appends)->paginate($limit);
    }
}
