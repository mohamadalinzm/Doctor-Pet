<?php
namespace Animal\Service\Validation\Resource;

use Animal\Support\Enum\Type;
use Illuminate\Support\Facades\Validator;

class AnimalUpdateValidator
{
    public static function check($data,$animalId)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:animals,name,' . $animalId,
            'type' => 'required|string|max:255',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        return Validator::make($data, $rules);
    }

}