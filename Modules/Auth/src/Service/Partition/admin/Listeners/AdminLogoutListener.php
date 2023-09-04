<?php

namespace Auth\Service\Partition\admin\Listeners;

use Auth\Service\Partition\Admin\Event\AuthUserLogoutEvent;
use Carbon\Carbon;

class AdminLogoutListener
{
    public function handle(AuthUserLogoutEvent $event , UserRepository $repository)
    {
        $userActivity = $repository->fetchUserActivity($event->user->id);
        $loginDuration = $userActivity->login_time->diffInSeconds($userActivity->logout_time);
        $data = [
            'logout_time' => Carbon::now(),
            'last_activity_time' => Carbon::now(),
            'login_duration' => $loginDuration,
            'status' => 'offline',
        ];
        $repository->updateUserActivity($event->user->id,$data);
    }
}