<?php
namespace MedicalCenter\Support\MedicalCenter;

use Ramsey\Uuid\Uuid;

class MedicalCenterSupport
{
    public static function generateHash()
    {
        return Uuid::uuid4()->getHex();
    }
}
