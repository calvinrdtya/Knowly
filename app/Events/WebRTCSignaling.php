<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebRTCSignaling implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;
    public $data;
    public $meetingId;

    public function __construct($type, $data, $meetingId)
    {
        $this->type = $type;
        $this->data = $data;
        $this->meetingId = $meetingId;
    }

    public function broadcastOn()
    {
        return new Channel('meeting.' . $this->meetingId);
    }
}