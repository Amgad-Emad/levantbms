<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'code', 'tag', 'title', 'description', 'scope_lines',
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
