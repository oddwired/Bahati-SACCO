<?php

namespace BahatiSACCO\Events;

use BahatiSACCO\Member;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MemberCreated
{
    use Dispatchable, SerializesModels;

    public $user;
    public $role;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        //
        $this->user = $member;
        $this->role = "member";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
