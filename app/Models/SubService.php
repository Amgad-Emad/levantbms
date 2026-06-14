<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubService extends Model
{
    protected $fillable = [
        'service_id', 'code', 'tag', 'title', 'description', 'scope_lines',
        'timeline', 'fee_from', 'is_published', 'position',
    ];

    protected $casts = [
        'tag' => AsTranslatable::class,
        'title' => AsTranslatable::class,
        'description' => AsTranslatable::class,
        'timeline' => AsTranslatable::class,
        'fee_from' => AsTranslatable::class,
        'scope_lines' => 'array', // {"en": [...], "ar": [...]}
        'is_published' => 'boolean',
    ];

    /** Parent service this sub-service belongs to. */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /** @return array<int, string> */
    public function scopeLinesFor(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $lines = $this->scope_lines ?? [];

        return ! empty($lines[$locale])
            ? $lines[$locale]
            : ($lines[config('app.fallback_locale', 'en')] ?? []);
    }
}
