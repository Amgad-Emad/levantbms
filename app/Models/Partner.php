<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'tag', 'region', 'body', 'services', 'website', 'is_published', 'position',
    ];

    protected $casts = [
        'name' => AsTranslatable::class,
        'tag' => AsTranslatable::class,
        'region' => AsTranslatable::class,
        'body' => AsTranslatable::class,
        'services' => 'array', // {"en": [...], "ar": [...]}
        'is_published' => 'boolean',
    ];

    /** @return array<int, string> */
    public function servicesFor(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $services = $this->services ?? [];

        return ! empty($services[$locale])
            ? $services[$locale]
            : ($services[config('app.fallback_locale', 'en')] ?? []);
    }

    public function logoUrl(): ?string
    {
        $media = $this->getFirstMedia('logo');

        return $media ? $media->getUrl() : null;
    }
}
