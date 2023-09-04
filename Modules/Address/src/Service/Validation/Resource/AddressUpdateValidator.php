<?php
namespace Address\Service\Validation\Resource;

use Address\Support\Enum\Type;
use Illuminate\Support\Facades\Validator;

class AddressUpdateValidator
{
    public static function check($data)
    {

        $rules = [
            'city_id' => 'sometimes|required|integer|exists:cities,id',
            'province_id' => 'sometimes|required|integer|exists:states,id',
            'type' => 'sometimes|required|in:' . implode(',', Type::getAsArray()),
            'address1' => 'sometimes|required|string|max:400',
            'area' => 'sometimes|required|string|max:100',
            'postal_code' => 'sometimes|required|string|max:10',
            'building' => 'sometimes|nullable|string|max:100',
            'floor' => 'sometimes|nullable|integer|min:0|max:150',
            'apartment' => 'sometimes|nullable|string|max:100|min:2',
            'latitude' => ['sometimes','nullable', 'regex:/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$/'],
            'longitude' => ['sometimes','nullable', 'regex:/^[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/'],
            'address2' => 'sometimes|nullable|string|max:400',
            'is_active' => 'sometimes|boolean',
            'is_default' => 'sometimes|boolean',
        ];

        return Validator::make($data, $rules);
    }

}