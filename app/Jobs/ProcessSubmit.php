<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
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
        $submissionSaved = DB::table('submissions')->insert([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($submissionSaved) {
            SubmissionSaved::dispatch(
                $this->name,
                $this->email,
            );
        }
    }
}
