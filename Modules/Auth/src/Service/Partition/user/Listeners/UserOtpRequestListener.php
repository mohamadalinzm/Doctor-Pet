<?php

namespace Auth\Service\Partition\user\Listeners;

use App\Models\Location;
use Auth\Service\Event\UserLoginEvent;
use Auth\Service\Partition\Admin\Event\AuthUserLoginEvent;
use Carbon\Carbon;
use Detection\MobileDetect;
use User\Service\Repository\UserRepository;

class UserOtpRequestListener
{
    public function handle(AuthUserLoginEvent $event, UserRepository $repo , MobileDetect $detect)
    {
        $data = [
            'user_id' => $event->user->id,
            'ip_address' => request()->getClientIp(),
            'ip_location' => Location::getCity(),
            'login_time' => Carbon::now(),
            'logout_time' => null,
            'user_agent' =>  request()->header('User-Agent'),
            'device_type' =>  $this->getDeviceType($detect),
            'last_activity_time' => Carbon::now(),
            'location' => $this->getLocation(),
            'login_duration' => null,
            'status' => 'online',
        ];
        $repo->userActivity($data);
    }

    function getDeviceType($detect): string {
        if ($detect->isMobile()) {
            return 'Mobile';
        } elseif ($detect->isTablet()) {
            return 'Tablet';
        } else {
            return 'Desktop';
        }
    }

    public function getLocation()
    {
        return [
            'city' => Location::getCity(),
            'country' => Location::getCountry(),
            'latitude' => Location::getLatitude(),
            'longitude' => Location::getLongitude(),
        ];
    }
}