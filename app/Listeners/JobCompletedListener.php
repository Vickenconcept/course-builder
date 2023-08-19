<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\JobCompleted;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class JobCompletedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(JobCompleted $event)
    // {
    //     $completedJobs = $event->completedJobs;
    //     $totalJobs = $event->totalJobs;

    //     if ($completedJobs === $totalJobs) {
    //         // All jobs in the batch are completed, redirect to the view
    //         return Redirect::route('content-planner.index');
    //     }
    // }
    public function handle(JobCompleted $event)
    {
        Log::info('JobCompleted event handled');

        //  Redirect::route('content-planner.index');
        $response = ['message' => 'Event handled successfully'];
        // dd($response);

        // Perform a redirect
        return redirect()->route('content-planner.index');
    }
}
