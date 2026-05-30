<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'slug', 'category', 'read_minutes', 'is_featured', 'is_published',
        'published_at', 'title', 'excerpt', 'body', 'position',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'title' => AsTranslatable::class,
        'excerpt' => AsTranslatable::class,
        'body' => AsTranslatable::class,
        'meta_title' => AsTranslatable::class,
        'meta_description' => AsTranslatable::class,
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function coverUrl(string $conversion = ''): ?string
    {
        $media = $this->getFirstMedia('cover');

        return $media ? $media->getUrl($conversion) : null;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(640)
            ->height(420)
            ->nonQueued();
    }
}
