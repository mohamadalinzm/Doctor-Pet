<?php

namespace Shift\Foundation\Decorator;

use General\Http\Responder\GeneralResponder;
use Illuminate\Support\Facades\Log;
use Shift\Model\Shift;
use Shift\Support\Message\ShiftLogMessage;
use Shift\ShiftInterface;

class TryCatchDecorator extends Management implements ShiftInterface
{
    protected ShiftInterface $service;

    public function __construct(ShiftInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function delete($Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->delete($Shift);
        },ShiftLogMessage::$failedInDelete);
    }


    public function store(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->service->store($data);
        },ShiftLogMessage::$failedInStore);
    }

    public function update(array $data, $Shift)
    {
        return $this->execute(function () use ($data, $Shift) {
            return $this->service->update($data, $Shift);
        },ShiftLogMessage::$failedInUpdate);
    }

    public function show(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->service->show($data);
        },ShiftLogMessage::$failedInShow);
    }

    public function edit(array $data)
    {
        return $this->execute(function () use ($data) {
            return $this->service->edit($data);
        },ShiftLogMessage::$failedInEdit);
    }

    public function isShiftExistInSellerStores(int $id, $stores)
    {
        return $this->execute(function () use ($id,$stores) {
            return $this->service->isShiftExistInSellerStores($id,$stores);
        },ShiftLogMessage::$failedInFetchDataFromStore);
    }

    public function isBanned($Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->isBanned($Shift);
        },ShiftLogMessage::$failedInCheckBanForShift);
    }


    public function isAlreadyBanned(Shift $Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->isAlreadyBanned($Shift);
        },ShiftLogMessage::$failedInCheckBanForShift);
    }


    public function ban(Shift $Shift)
    {
        return $this->execute(function () use ($Shift) {
            return $this->service->ban($Shift);
        },ShiftLogMessage::$failedInBan);
    }

    public function information()
    {
        return $this->execute(function () {
            return $this->service->information();
        },ShiftLogMessage::$failedInRetrieveInformation);
    }


    public function activation(bool $activation, $Shift)
    {
        return $this->execute(function () use ($activation,$Shift){
            return $this->service->activation($activation,$Shift);
        },ShiftLogMessage::$failedInChangeShiftStatus);
    }

    public function listing(int $limit, array $appends, array $select)
    {
        return $this->execute(function () use ($limit,$appends,$select){
            return $this->service->listing($limit,$appends,$select);
        },ShiftLogMessage::$failedInList);
    }

    public function isShiftHaveAnyStore(int $id)
    {
        return $this->execute(function () use ($id){
            return $this->service->check($id);
        },ShiftLogMessage::$failedInList);
    }


    public function activities($select = [], $appends = [])
    {
        return $this->execute(function () use ($select,$appends){
            return $this->service->listing($select,$appends);
        },ShiftLogMessage::$failedInFetchActivities);
    }


    public function fetch(int $id, array $appends = [], array $select = [])
    {
        return $this->execute(function () use ($id,$appends,$select){
            return $this->service->fetch($id,$appends,$select);
        },ShiftLogMessage::$failedInFetchShift);
    }

    protected function execute(callable $callback,$message)
    {
        try {
            return $callback();
        } catch (\Exception $e) {
            Log::error($message.$e->getMessage());
            GeneralResponder::Exception($e->getMessage(), $e->getCode());
        }
    }
}
