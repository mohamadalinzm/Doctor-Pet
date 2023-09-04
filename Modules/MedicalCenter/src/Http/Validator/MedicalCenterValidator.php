<?php

namespace MedicalCenter\Http\Validator;

use MedicalCenter\Models\MedicalCenter;
use Illuminate\Support\Facades\Validator;

class MedicalCenterValidator
{
    public static function check($data, $medicalCenter = null)
    {
        $rules = [
            'name' => 'required|string|max:191',
            'mobile' => 'required|numeric',
            'phone' => 'required|numeric',
            'on_site_visit' => 'required|boolean',
            'status' => 'required|string',
            'type_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'address' => 'required|text',
            'image' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2000',
            'certificate' => 'nullable|file|image|mimes:jpeg,jpg,png|max:2000',
            'services' => 'required|string',
        ];

        if ($medicalCenter) {
            $rules['slug'] = 'required|string|max:191|unique:'.MedicalCenter::getTableName().',slug,' . $medicalCenter->id;
        }
        return Validator::make($data, $rules);
    }
}
