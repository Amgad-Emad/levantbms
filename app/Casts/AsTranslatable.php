<?php

namespace App\Casts;

use App\Support\Translatable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * Casts a JSON column ({"en": "...", "ar": "..."}) to a {@see Translatable}.
 */
class AsTranslatable implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Translatable
    {
        if ($value === null) {
            return new Translatable([]);
        }

        $decoded = is_array($value) ? $value : json_decode($value, true);

        return new Translatable(is_array($decoded) ? $decoded : []);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if ($value instanceof Translatable) {
            $value = $value->toArray();
        }

        if (is_string($value)) {
            $value = ['en' => $value];
        }

        if (! is_array($value)) {
            $value = [];
        }

        // Drop empty locale entries so fallback logic stays clean.
        $value = array_filter($value, fn ($v) => $v !== null && $v !== '');

        return [$key => json_encode($value, JSON_UNESCAPED_UNICODE)];
    }
}
