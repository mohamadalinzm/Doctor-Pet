<?php

namespace Pet\Support\Message;

class PetMessage
{
    public static string $PetAlreadyExisted = 'Pet Already Existed !';

    public static string $PetCantDeletedByYou = 'Pet Cant Deleted By You !';

    public static string $PetValidationFailed = 'Pet Validation Failed !';

    public static string $PetIsNotActive = 'Pet Is Not Active !';

    public static string $PetOverLimitation = 'You Cant Add More Than 5 Pet';

    public static string $PetCantSeeByYou = 'Pet Cant See By You !';

    public static string $PetDefaultIsAlreadyWasInThisStatus = 'Pet Default Is Already Was In This Status !';

    public static string $PetStored = 'Pet Successfully Added !';

    public static string $PetUpdated = 'Pet Successfully Updated !';

    public static string $PetSetDefault = 'Defaulted Pet Changed To New One !';

    public static string $PetNotFound = 'Pet Not Found !';

    public static string $PetDeleted = 'Pet Successfully Deleted !';

    public static string $PetCantAlterByThisUser = 'Pet Cant Alter By You !';

    public static string $PetNotBelongsToYou = 'Pet Successfully Deleted !';

    public static function PetCreateNotification($user, $Pet)
    {
        return "You (".$user->name.") Created An Pet (".$Pet->Pet1.") In ".$Pet->created_at ;
    }

    public static function PetDeleteNotification($user, $Pet)
    {
        return "You (".$user->name.") Deleted Pet (".$Pet->Pet1.") In ".$Pet->deleted_at ;
    }

    public static function PetUpdateNotification($user, $Pet)
    {
        return "You (".$user->name.") Update Pet (".$Pet->Pet1.") In ".$Pet->updated_at ;
    }

    public static function PetSetAsDefaultNotification($user, $Pet)
    {
        return "You (".$user->name.") SetAsDefault Pet (".$Pet->Pet1.") In ".$Pet->updated_at ;
    }
}
