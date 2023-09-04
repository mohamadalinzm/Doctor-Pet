<?php
namespace Animal\Service\Validation\Resource;

use Animal\Support\Enum\Type;
use Illuminate\Support\Facades\Validator;

class AnimalStoreValidator
{
    public static function check($data)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:animals,name',
            'type' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        return Validator::make($data, $rules);
    }

}