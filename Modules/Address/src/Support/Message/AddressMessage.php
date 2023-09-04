<?php

namespace Address\Support\Message;

class AddressMessage
{
    public static string $AddressAlreadyExisted = 'Address Already Existed !';

    public static string $AddressCantDeletedByYou = 'Address Cant Deleted By You !';

    public static string $AddressValidationFailed = 'Address Validation Failed !';

    public static string $AddressIsNotActive = 'Address Is Not Active !';

    public static string $AddressOverLimitation = 'You Cant Add More Than 5 Address';

    public static string $AddressCantSeeByYou = 'Address Cant See By You !';

    public static string $AddressDefaultIsAlreadyWasInThisStatus = 'Address Default Is Already Was In This Status !';

    public static string $AddressStored = 'Address Successfully Added !';

    public static string $AddressUpdated = 'Address Successfully Updated !';

    public static string $AddressSetDefault = 'Defaulted Address Changed To New One !';

    public static string $AddressNotFound = 'Address Not Found !';

    public static string $AddressDeleted = 'Address Successfully Deleted !';

    public static string $AddressCantAlterByThisUser = 'Address Cant Alter By You !';

    public static string $AddressNotBelongsToYou = 'Address Successfully Deleted !';

    public static function AddressCreateNotification($user, $address)
    {
        return "You (".$user->name.") Created An Address (".$address->address1.") In ".$address->created_at ;
    }

    public static function AddressDeleteNotification($user, $address)
    {
        return "You (".$user->name.") Deleted Address (".$address->address1.") In ".$address->deleted_at ;
    }

    public static function AddressUpdateNotification($user, $address)
    {
        return "You (".$user->name.") Update Address (".$address->address1.") In ".$address->updated_at ;
    }

    public static function AddressSetAsDefaultNotification($user, $address)
    {
        return "You (".$user->name.") SetAsDefault Address (".$address->address1.") In ".$address->updated_at ;
    }
}
