<?php
namespace Address\Service\Validation\Resource;

use Illuminate\Support\Facades\Validator;

class AddressListValidator
{
    public static function check($data)
    {


        return Validator::make($data, [], []);
    }

}