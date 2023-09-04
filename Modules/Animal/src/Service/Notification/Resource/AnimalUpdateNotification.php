<?php

namespace Animal\Service\Notification\Resource;

use Animal\Model\Animal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use User\Support\Message\UserMessage;

class AnimalUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Animal $Animal;
    protected $user;
    protected string $action;

    public function __construct($user,Animal $Animal)
    {
        $this->Animal = $Animal;
        $this->user = $user;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'Animal_id' => $this->Animal->id,
            'Animal1' => $this->Animal->Animal1,
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'message' => UserMessage::AnimalUpdateNotification($this->user,$this->Animal)
        ];
    }
}
