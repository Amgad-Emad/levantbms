<?php

namespace App\Translation;

use App\Models\Content;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\FileLoader;

/**
 * Merges editable database content over the `front` language files.
 *
 * The front-end uses flat dotted keys (e.g. `__('front.home.h1a')`), which the
 * lang files store as literal array keys. We mirror that flat shape so a DB row
 * keyed `home.h1a` transparently overrides the file value, with the file acting
 * as the fallback when no row exists.
 */
class DatabaseTranslationLoader extends FileLoader
{
    public function load($locale, $group, $namespace = null)
    {
        $fileLines = parent::load($locale, $group, $namespace);

        if (($namespace === null || $namespace === '*') && $group === 'front') {
            return array_replace($fileLines, $this->databaseLines($locale));
        }

        return $fileLines;
    }

    /**
     * @return array<string, string>
     */
    protected function databaseLines(string $locale): array
    {
        return Cache::rememberForever("front_translations:{$locale}", function () use ($locale) {
            try {
                $rows = Content::where('group', 'front')->get(['key', 'values']);
            } catch (\Throwable) {
                // Table not migrated yet (e.g. during install) — fall back to files.
                return [];
            }

            $lines = [];

            foreach ($rows as $row) {
                $value = $row->translate($locale);

                if ($value !== '') {
                    $lines[$row->key] = $value;
                }
            }

            return $lines;
        });
    }
}
