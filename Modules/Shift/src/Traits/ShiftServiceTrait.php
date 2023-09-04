<?php

namespace Shift\Traits;

use Auth\OTP\Contract\OTP;

trait ShiftServiceTrait
{
    public function store($data)
    {
        return $this->ShiftRepository->save($data);
    }

    public function update($data, $shift)
    {
        return $this->ShiftRepository->update($data, $shift);
    }

    public function delete($shift)
    {
        return $this->ShiftRepository->delete($shift);
    }

    public function fetch($id, $appends = [], $select = [])
    {
        $user = $this->UserRepository->fetch($id, $appends, $select);
        if (! $user) {
            return $this->response->UserNotFound();
        }

        return $user;
    }

    public function list($limit = 5, $appends = [], $select = [], $storeIds = [])
    {
        return $this->UserRepository->list($limit, $appends, $select, $storeIds);
    }
}