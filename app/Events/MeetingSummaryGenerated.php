<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MeetingSummaryGenerated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $summary;

    public function __construct($id, $summary)
    {
        $this->id = $id;
        $this->summary = $summary;
    }

    public function broadcastOn()
    {
        return new Channel('meeting-channel');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->id,
            'summary' => $this->summary,
        ];
    }
}
