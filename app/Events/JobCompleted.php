<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;



class JobCompleted
{
    use Dispatchable, SerializesModels;

    public $completedJobs;
    public $totalJobs;

    /**
     * Create a new event instance.
     *
     * @param int $completedJobs
     * @param int $totalJobs
     */
    // public function __construct($completedJobs, $totalJobs)
    // {
    //     $this->completedJobs = $completedJobs;
    //     $this->totalJobs = $totalJobs;

    // }
    public function __construct()
    {
        Log::info('JobCompleted event dispatched');
 
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    // public function broadcastOn(): array
    // {
    //     return [
    //         new PrivateChannel('job-completed'),

    //     ];
    // }
}
