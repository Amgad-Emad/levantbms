<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SeoMeta extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['page', 'title', 'description', 'keywords', 'robots', 'canonical'];

    protected $casts = [
        'title' => AsTranslatable::class,
        'description' => AsTranslatable::class,
        'keywords' => AsTranslatable::class,
    ];

    public function ogImageUrl(): ?string
    {
        $media = $this->getFirstMedia('og');

        return $media ? $media->getUrl() : null;
    }

    public static function forPage(string $page): ?self
    {
        return static::where('page', $page)->first();
    }
}
