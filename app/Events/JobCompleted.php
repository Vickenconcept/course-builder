<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subtopic;
    public $detailedExplanation;
    public $success;
    public $errorMessage;

    /**
     * Create a new event instance.
     */
    public function __construct($subtopic, $detailedExplanation, $success = true, $errorMessage = null)
    {
        $this->subtopic = $subtopic;
        $this->detailedExplanation = $detailedExplanation;
        $this->success = $success;
        $this->errorMessage = $errorMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('job-completed'),
            
        ];
    }
}
