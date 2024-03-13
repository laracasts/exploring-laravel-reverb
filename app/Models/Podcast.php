<?php

namespace App\Models;

use App\PodcastStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Podcast extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => PodcastStatus::class,
            'published_at' => 'datetime',
        ];
    }

    public function name(): Attribute
    {
        return Attribute::get(fn ($value) => str($value)->apa());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
