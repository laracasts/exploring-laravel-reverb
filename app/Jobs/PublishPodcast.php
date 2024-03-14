<?php

namespace App\Jobs;

use App\Events\PodcastPublished;
use App\Models\Podcast;
use App\PodcastStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Podcast $podcast)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(5); // We're publishing the podcast…

        $this->podcast->update([
            'status' => PodcastStatus::Published,
            'published_at' => now(),
        ]);

        PodcastPublished::dispatch($this->podcast);
        $this->podcast->user->notify(new \App\Notifications\PodcastPublished($this->podcast));
    }
}
