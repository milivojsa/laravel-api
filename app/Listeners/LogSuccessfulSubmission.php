<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSuccessfulSubmission
{
    /**
     * Handle the event.
     */
    public function handle(SubmissionSaved $event): void
    {
        Log::info("Submission Saved. Name: $event->name Email: $event->email");
    }
}
