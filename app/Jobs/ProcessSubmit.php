<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ProcessSubmit implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $message
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        if ($submission) {
            SubmissionSaved::dispatch(
                $this->name,
                $this->email,
            );
        }
    }
}
