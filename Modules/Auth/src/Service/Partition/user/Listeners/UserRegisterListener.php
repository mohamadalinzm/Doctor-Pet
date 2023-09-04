<?php

namespace Auth\Service\Partition\user\Listeners;

use Auth\Service\Event\UserLogoutEvent;
use Carbon\Carbon;
use User\Service\Repository\UserRepository;

class UserRegisterListener
{
    public function handle(UserLogoutEvent $event , UserRepository $repository)
    {
        $userActivity = $repository->fetchUserActivity($event->user->id);
        $loginDuration = $userActivity->login_time->diffInSeconds($userActivity->logout_time);;
        $data = [
            'logout_time' => Carbon::now(),
            'last_activity_time' => Carbon::now(),
            'login_duration' => $loginDuration,
            'status' => 'offline',
        ];
        $repository->updateUserActivity($event->user->id,$data);
    }
}