<?php

namespace User\Service;

use User\Model\User;

interface UserResponseInterface
{
    public function UserAlreadyBanned();

    public function UserAlreadyExisted();

    public function UserDeletedSuccess();

    public function UserValidationFailed($errors);

    public function UserBanSuccess();

    public function UserStoredSuccess();

    public function UserUpdatedSuccess();

    public function UserUpdatedActivation();

    public function UserNotFound();

    public function UserEdit(array $data, User $User);

    public function UserShow($User);

    public function UserCreate($data);

    public function UserList($users);

}
