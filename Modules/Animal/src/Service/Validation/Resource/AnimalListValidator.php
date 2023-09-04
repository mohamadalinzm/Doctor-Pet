<?php
namespace Animal\Service\Validation\Resource;

use Illuminate\Support\Facades\Validator;

class AnimalListValidator
{
    public static function check($data)
    {
        return Validator::make($data, [], []);
    }

}