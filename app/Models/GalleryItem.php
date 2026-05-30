<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryItem extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category', 'label', 'ratio', 'is_published', 'position',
    ];

    protected $casts = [
        'label' => AsTranslatable::class,
        'is_published' => 'boolean',
    ];

    public function imageUrl(string $conversion = ''): ?string
    {
        $media = $this->getFirstMedia('image');

        return $media ? $media->getUrl($conversion) : null;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(600)
            ->nonQueued();
    }
}
