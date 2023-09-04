<?php

namespace Pet\Service\Notification\Resource;

use Pet\Model\Pet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use User\Support\Message\UserMessage;

class PetUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Pet $Pet;
    protected $user;
    protected string $action;

    public function __construct($user,Pet $Pet)
    {
        $this->Pet = $Pet;
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'Pet_id' => $this->Pet->id,
            'Pet1' => $this->Pet->Pet1,
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'message' => UserMessage::PetUpdateNotification($this->user,$this->Pet)
        ];
    }
}
