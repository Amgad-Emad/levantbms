<?php

namespace App\Models;

use App\Casts\AsTranslatable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'category', 'question', 'answer', 'is_published', 'position',
    ];

    protected $casts = [
        'question' => AsTranslatable::class,
        'answer' => AsTranslatable::class,
        'is_published' => 'boolean',
    ];
}
