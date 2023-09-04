<?php

namespace MedicalCenter\Responder\Type;

use App\Models\Notification;
use MedicalCenter\Support\Type\MedicalCenterTypeMessage;
use function redirect;
use function view;

class MedicalCenterTypeWebResponder
{

    public function list($types)
    {
        return $types;
    }

    public function adminMedicalCenterList($types)
    {
        return view('type_view::admin.index', compact('types'));
    }

    public function validationFailed(array $messages)
    {
        return redirect()->back()->withInput()->withErrors($messages);
    }

    public function storedSuccessfully($type)
    {
        return redirect()->route('types.index')
            ->with('notification', Notification::message(MedicalCenterTypeMessage::$typeSavedSuccessfully, 'success', 8000));
    }


    public function updatedSuccessfully($type)
    {
        return redirect()->route('types.edit', $type->uuid)
            ->with('notification', Notification::message(MedicalCenterTypeMessage::$typeUpdatedSuccessfully, 'success', 8000));
    }

    public function deletedSuccessfully($type)
    {
        return redirect()->route('types.index')
            ->with('notification', Notification::message(MedicalCenterTypeMessage::$typeDeletedSuccessfully, 'success', 8000));
    }

    public function restoredSuccessfully()
    {
        return redirect()->route('types.index')
            ->with('notification', Notification::message(MedicalCenterTypeMessage::$typeRestoredSuccessfully, 'success', 8000));
    }
    public function enabledSuccessfully($type)
    {
        return redirect()->back()
            ->with('notification', Notification::message(MedicalCenterTypeMessage::$typeEnabledSuccessfully, 'success', 8000));
    }
    public function disabledSuccessfully($type)
    {
        return redirect()->back()
            ->with('notification', Notification::message(MedicalCenterTypeMessage::$typeDisabledSuccessfully, 'success', 8000));
    }
}
