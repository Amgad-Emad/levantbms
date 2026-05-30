<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Content extends Model
{
    protected $fillable = ['group', 'key', 'values', 'type', 'page', 'section', 'position'];

    protected $casts = [
        'values' => 'array',
    ];

    /** Locales the CMS edits. */
    public const LOCALES = ['en', 'ar'];

    public function translate(?string $locale = null): string
    {
        $locale ??= app()->getLocale();
        $values = $this->values ?? [];

        return (string) ($values[$locale]
            ?? $values[config('app.fallback_locale', 'en')]
            ?? '');
    }

    protected static function booted(): void
    {
        $flush = function () {
            foreach (self::LOCALES as $locale) {
                Cache::forget("front_translations:{$locale}");
            }
        };

        static::saved($flush);
        static::deleted($flush);
    }
}
