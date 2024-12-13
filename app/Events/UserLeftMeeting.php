<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserLeftMeeting implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $meetingId;

    public function __construct($user, $meetingId)
    {
        $this->user = $user;
        $this->meetingId = $meetingId;
    }

    public function broadcastOn()
    {
        return new Channel('meeting.' . $this->meetingId);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->user['name'] . ' left the meeting.',
            'user' => $this->user
        ];
    }
}
