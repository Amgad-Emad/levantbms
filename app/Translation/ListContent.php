<?php

namespace App\Translation;

/**
 * Bridges the gap between list-shaped front translations (arrays in the lang
 * files) and the CMS, which can only edit flat text rows.
 *
 * Each listed key is stored as a single editable textarea — one item per line —
 * and decoded back into the array shape the front-end blades expect. The seeder
 * encodes the lang default; the DatabaseTranslationLoader decodes admin edits.
 */
class ListContent
{
    /**
     * Front keys whose lang value is a list, mapped to their item shape:
     *  - 'lines' => a plain list of strings (one per line)
     *  - 'pairs' => a list of ['t' => title, 'd' => description] (one "Title | Description" per line)
     */
    public const KEYS = [
        'home.marquee'       => 'lines',
        'about.moicServices' => 'lines',
        'about.corpServices' => 'lines',
        'about.cbbServices'  => 'lines',
        'about.mdCreds'      => 'lines',
        'about.companies'    => 'lines',
        'about.mdExpertise'  => 'pairs',
    ];

    public static function isList(string $key): bool
    {
        return isset(self::KEYS[$key]);
    }

    /** Encode a lang array into editable, one-item-per-line text. */
    public static function encode(string $key, array $items): string
    {
        if ((self::KEYS[$key] ?? null) === 'pairs') {
            return implode("\n", array_map(
                fn ($item) => trim(($item['t'] ?? '').' | '.($item['d'] ?? '')),
                $items
            ));
        }

        return implode("\n", $items);
    }

    /** Decode edited text back into the array shape the front-end expects. */
    public static function decode(string $key, string $text): array
    {
        $lines = array_values(array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n/', $text)),
            fn ($line) => $line !== ''
        ));

        if ((self::KEYS[$key] ?? null) === 'pairs') {
            return array_map(function ($line) {
                [$title, $desc] = array_pad(explode('|', $line, 2), 2, '');

                return ['t' => trim($title), 'd' => trim($desc)];
            }, $lines);
        }

        return $lines;
    }

    /** Helper text shown beneath the field in the CMS. */
    public static function hint(string $key): ?string
    {
        if (! self::isList($key)) {
            return null;
        }

        return self::KEYS[$key] === 'pairs'
            ? 'One item per line, written as “Title | Description”.'
            : 'One item per line.';
    }
}
