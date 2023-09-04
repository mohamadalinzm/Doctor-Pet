<?php

namespace Shift\Http\Controller;

use Illuminate\Routing\Controller;
use Shift\ShiftInterface;
use User\Model\User;

class DoctorShiftController extends ShiftBaseController
{
    public function index()
    {
        return $this->service->list();
    }


    public function store()
    {
        return $this->service->store(request()->all());
    }


    public function show($id)
    {
        return $this->service->fetch($id);
    }


    public function update($id)
    {
        return $this->service->update(request()->all(),$id);
    }


    public function delete($id)
    {
        return $this->service->delete($id);
    }

}
