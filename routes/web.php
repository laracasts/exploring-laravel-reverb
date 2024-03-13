<?php

use App\Http\Controllers\ProfileController;
use App\Jobs\PublishPodcast;
use App\Models\Podcast;
use App\PodcastStatus;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/podcasts', function (Request $request) {
    return Inertia::render('Podcasts/Index', [
        'podcasts' => $request->user()->podcasts()->latest()->paginate(10),
    ]);
})->middleware(['auth', 'verified'])->name('podcasts.index');

Route::put('/podcasts/{podcast}/publish', function (Request $request, Podcast $podcast) {
    $podcast->update(['status' => PodcastStatus::Publishing]);
    PublishPodcast::dispatch($podcast);

    return back();
})->middleware(['auth', 'verified'])->name('podcasts.publish');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
