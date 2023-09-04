<?php
namespace Address\Service\Validation\Resource;

use Address\Support\Enum\Type;
use Illuminate\Support\Facades\Validator;

class AddressStoreValidator
{
    public static function check($data)
    {

        $rules = [
            'city_id' => 'required|integer|exists:cities,id',
            'province_id' => 'required|integer|exists:provinces,id',
            'type' => 'required|in:' . implode(',', Type::getAsArray()),
            'address1' => 'required|string|max:400',
            'postal_code' => 'required|string|max:10',
            'latitude' => ['nullable', 'regex:/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$/'],
            'longitude' => ['nullable', 'regex:/^[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/'],
            'is_default' => 'sometimes|boolean',
        ];

        return Validator::make($data, $rules);
    }

}