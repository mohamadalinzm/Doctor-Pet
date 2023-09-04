<?php

namespace Animal\Support\Message;

class AnimalMessage
{
    public static string $AnimalAlreadyExisted = 'Animal Already Existed !';

    public static string $AnimalCantDeletedByYou = 'Animal Cant Deleted By You !';

    public static string $AnimalValidationFailed = 'Animal Validation Failed !';

    public static string $AnimalIsNotActive = 'Animal Is Not Active !';

    public static string $AnimalOverLimitation = 'You Cant Add More Than 5 Animal';

    public static string $AnimalCantSeeByYou = 'Animal Cant See By You !';

    public static string $AnimalDefaultIsAlreadyWasInThisStatus = 'Animal Default Is Already Was In This Status !';

    public static string $AnimalStored = 'Animal Successfully Added !';

    public static string $AnimalUpdated = 'Animal Successfully Updated !';

    public static string $AnimalSetDefault = 'Defaulted Animal Changed To New One !';

    public static string $AnimalNotFound = 'Animal Not Found !';

    public static string $AnimalDeleted = 'Animal Successfully Deleted !';

    public static string $AnimalCantAlterByThisUser = 'Animal Cant Alter By You !';

    public static string $AnimalNotBelongsToYou = 'Animal Successfully Deleted !';

    public static function AnimalCreateNotification($user, $Animal)
    {
        return "You (".$user->name.") Created An Animal (".$Animal->Animal1.") In ".$Animal->created_at ;
    }

    public static function AnimalDeleteNotification($user, $Animal)
    {
        return "You (".$user->name.") Deleted Animal (".$Animal->Animal1.") In ".$Animal->deleted_at ;
    }

    public static function AnimalUpdateNotification($user, $Animal)
    {
        return "You (".$user->name.") Update Animal (".$Animal->Animal1.") In ".$Animal->updated_at ;
    }

    public static function AnimalSetAsDefaultNotification($user, $Animal)
    {
        return "You (".$user->name.") SetAsDefault Animal (".$Animal->Animal1.") In ".$Animal->updated_at ;
    }
}
