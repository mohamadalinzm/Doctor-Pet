<?php

namespace MedicalCenter\Responder\MedicalCenter;

use App\Models\Notification;
use MedicalCenter\Support\MedicalCenter\MedicalCenterMessage;
use function redirect;
use function view;

class MedicalCenterWebResponder
{

    public function list($medicalCenters)
    {
        return $medicalCenters;
    }

    public function adminMedicalCenterList($medicalCenters)
    {
        return view('medicalCenter_view::admin.index', compact('medicalCenters'));
    }

    public function validationFailed(array $messages)
    {
        return redirect()->back()->withInput()->withErrors($messages);
    }

    public function storedSuccessfully($medicalCenter)
    {
        return redirect()->route('medicalCenters.index')
            ->with('notification', Notification::message(MedicalCenterMessage::$medicalCenterSavedSuccessfully, 'success', 8000));
    }


    public function updatedSuccessfully($medicalCenter)
    {
        return redirect()->route('medicalCenters.edit', $medicalCenter->uuid)
            ->with('notification', Notification::message(MedicalCenterMessage::$medicalCenterUpdatedSuccessfully, 'success', 8000));
    }

    public function deletedSuccessfully($medicalCenter)
    {
        return redirect()->route('medicalCenters.index')
            ->with('notification', Notification::message(MedicalCenterMessage::$medicalCenterDeletedSuccessfully, 'success', 8000));
    }

    public function restoredSuccessfully()
    {
        return redirect()->route('medicalCenters.index')
            ->with('notification', Notification::message(MedicalCenterMessage::$medicalCenterRestoredSuccessfully, 'success', 8000));
    }
    public function enabledSuccessfully($medicalCenter)
    {
        return redirect()->back()
            ->with('notification', Notification::message(MedicalCenterMessage::$medicalCenterEnabledSuccessfully, 'success', 8000));
    }
    public function disabledSuccessfully($medicalCenter)
    {
        return redirect()->back()
            ->with('notification', Notification::message(MedicalCenterMessage::$medicalCenterDisabledSuccessfully, 'success', 8000));
    }
}
