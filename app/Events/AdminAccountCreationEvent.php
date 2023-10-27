<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminAccountCreationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $password;
    public $subject;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $password, $subject)
    {
        $this->user = $user;
        $this->password = $password;
        $this->subject = $subject;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
