<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageImage extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['page', 'slot'];

    public function imageUrl(string $conversion = ''): ?string
    {
        $media = $this->getFirstMedia('image');

        return $media ? $media->getUrl($conversion) : null;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(600)->height(750)->nonQueued();
    }

    /** Convenience accessor for views: PageImage::url('about', 'harbour'). */
    public static function url(string $page, string $slot, string $conversion = ''): ?string
    {
        return static::where('page', $page)->where('slot', $slot)->first()?->imageUrl($conversion);
    }
}
