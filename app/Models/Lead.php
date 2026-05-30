<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'topic', 'message',
        'status', 'locale', 'ip', 'user_agent',
    ];

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }
}
