<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MeetingStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $host;
    public $subject;

    public function __construct($id, $host, $subject)
    {
        $this->id = $id;
        $this->host = $host;
        $this->subject = $subject;
    }

    public function broadcastOn()
    {
        return new Channel('meeting-channel');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->id,
            'host' => $this->host,
            'subject' => $this->subject,
        ];
    }
}
