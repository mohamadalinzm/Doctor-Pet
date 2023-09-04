<?php
namespace Pet\Service\Validation\Resource;

use Pet\Support\Enum\Type;
use Illuminate\Support\Facades\Validator;

class PetStoreValidator
{
    public static function check($data)
    {

        $rules = [
            'name' => 'required|string',
            'animal_id' => 'required|exists:animals,id',
            'race' => 'required|string',
            'age' => 'required|integer',
            'type' => 'required|string',
            'kind' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthDate' => 'required|date',
        ];

        return Validator::make($data, $rules);
    }

}