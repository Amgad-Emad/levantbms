<?php

namespace App\Support;

use ArrayAccess;
use JsonSerializable;
use Stringable;

/**
 * A small bilingual value object: stores {"en": "...", "ar": "..."}.
 *
 * - Casting to string returns the current-locale value (with fallback).
 * - Array access exposes the raw per-locale values for edit forms: $model->title['en'].
 */
class Translatable implements ArrayAccess, JsonSerializable, Stringable
{
    public function __construct(public array $values = [])
    {
    }

    public function get(?string $locale = null): string
    {
        $locale ??= app()->getLocale();

        $value = $this->values[$locale]
            ?? $this->values[config('app.fallback_locale', 'en')]
            ?? null;

        if ($value === null || $value === '') {
            $value = collect($this->values)->first(fn ($v) => filled($v)) ?? '';
        }

        return is_array($value) ? '' : (string) $value;
    }

    public function __toString(): string
    {
        return $this->get();
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->values[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->values[] = $value;
        } else {
            $this->values[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->values[$offset]);
    }

    public function toArray(): array
    {
        return $this->values;
    }

    public function jsonSerialize(): mixed
    {
        return $this->values;
    }
}
