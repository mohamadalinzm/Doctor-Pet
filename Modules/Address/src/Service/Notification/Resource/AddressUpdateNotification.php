<?php

namespace Address\Service\Notification\Resource;

use Address\Model\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use User\Support\Message\UserMessage;

class AddressUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Address $address;
    protected $user;
    protected string $action;

    public function __construct($user,Address $address)
    {
        $this->address = $address;
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'address_id' => $this->address->id,
            'address1' => $this->address->address1,
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'message' => UserMessage::AddressUpdateNotification($this->user,$this->address)
        ];
    }
}
