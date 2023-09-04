<?php

namespace Shift\Foundation\Driver;

use Shift\EmployeeInterface;
use Shift\Foundation\Abstraction\ShiftAbstract;
use Shift\Foundation\Service\ShiftService;
use Shift\Service\Policies\AdminPolicyService;
use Shift\Service\Policies\DoctorPolicyService;
use Shift\Service\ShiftPolicyInterface;
use Shift\ShiftInterface;
use Shift\Support\ShiftHelper;
use Shift\Traits\SellerFunctionality;
use Shift\Traits\ServiceFunctionality;
use Shift\Traits\ShiftServiceTrait;

class DoctorShiftDriver extends ShiftAbstract implements ShiftInterface
{
    use ShiftServiceTrait;

    public $service;
    public $policy;

    public function __construct(ShiftService $service)
    {
        parent::__construct();
        $this->service = $service;
        $this->policy = app(ShiftPolicyInterface::class);
    }

    public function store(array $data)
    {
        // Validate Data
        $shift = $this->validation->store($data);

        // Check Is Shift Can Store Shift With Policy
        $this->policy->authorize('store',$shift);

        // Store Shift
        $this->service->store($data);

        // Run Created Event
        $this->event->create(auth()->user());

        // Return Json || Web Response
        return $this->response->ShiftStoredSuccess($shift);
    }

    public function update(array $data, $shiftId)
    {
        // Validate Data
        $this->validation->update($data,$shiftId);

        // Check Is Shift Existed
        $shift = $this->service->fetch($shiftId);

        // Check Is Shift Can Update Shift With Policy
        $this->policy->authorize('update',$shift);

        // Update Shift
        $this->service->update($data,$shift);

        // Run Update Event
        $this->event->update($shift);

        // Return Json || Web Response
        return $this->response->ShiftUpdatedSuccess($shift);
    }

    public function delete($shiftId)
    {
        // Check Is Shift Existed
        $shift = $this->service->fetch($shiftId);

        // Check Is Shift Can Delete Shift With Policy
        $this->policy->authorize('delete',$shift);

        // Delete Shift
        $this->service->delete($shift);

        // Run Delete Event
        $this->event->delete($shift);

        // Return Json || Web Response
        return $this->response->ShiftDeletedSuccess();
    }

    public function list(array $appends =null , array $filters = null , int $limit = 25)
    {
        // Validate Filters
        $data = $this->validation->list($filters);

        // Check Is Shift Can Delete Shift With Policy
        $this->policy->authorize('list');

        // Get Result With Appends
        $shiftes = $this->service->list($appends,$data,$limit);

        // Show Result With Limitation & Filters
        return $this->transformer->list($shiftes);
    }


}
