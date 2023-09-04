<?php

namespace MedicalCenter\Responder\Service;

use App\Models\Notification;
use MedicalCenter\Support\Service\ServiceMessage;
use function redirect;
use function view;

class ServiceWebResponder
{

    public function list($services)
    {
        return $services;
    }

    public function adminMedicalCenterList($services)
    {
        return view('service_view::admin.index', compact('services'));
    }

    public function validationFailed(array $messages)
    {
        return redirect()->back()->withInput()->withErrors($messages);
    }

    public function storedSuccessfully($service)
    {
        return redirect()->route('services.index')
            ->with('notification', Notification::message(ServiceMessage::$serviceSavedSuccessfully, 'success', 8000));
    }


    public function updatedSuccessfully($service)
    {
        return redirect()->route('services.edit', $service->uuid)
            ->with('notification', Notification::message(ServiceMessage::$serviceUpdatedSuccessfully, 'success', 8000));
    }

    public function deletedSuccessfully($service)
    {
        return redirect()->route('services.index')
            ->with('notification', Notification::message(ServiceMessage::$serviceDeletedSuccessfully, 'success', 8000));
    }

    public function restoredSuccessfully()
    {
        return redirect()->route('services.index')
            ->with('notification', Notification::message(ServiceMessage::$serviceRestoredSuccessfully, 'success', 8000));
    }
    public function enabledSuccessfully($service)
    {
        return redirect()->back()
            ->with('notification', Notification::message(ServiceMessage::$serviceEnabledSuccessfully, 'success', 8000));
    }
    public function disabledSuccessfully($service)
    {
        return redirect()->back()
            ->with('notification', Notification::message(ServiceMessage::$serviceDisabledSuccessfully, 'success', 8000));
    }
}
