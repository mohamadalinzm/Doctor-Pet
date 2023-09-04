<?php
namespace Pet\Service\Validation\Resource;

use Illuminate\Support\Facades\Validator;

class PetListValidator
{
    public static function check($data)
    {


        return Validator::make($data, [], []);
    }

}