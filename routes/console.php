<?php

use App\Models\Podcast;
use App\PodcastStatus;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('reset-state', function () {
    Podcast::where('id', '>', 0)->update([
        'status' => PodcastStatus::Unpublished,
        'published_at' => null,
    ]);
})->purpose('Reset application state to the default.');
