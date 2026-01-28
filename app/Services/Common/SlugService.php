<?php

namespace App\Services\Common;

use Illuminate\Support\Str;

class SlugService
{
    public function generate(
        string $value,
        string $modelClass,
        ?int $ignoreId = null,
        string $slugColumn = 'slug',
        string $idColumn = 'id'
    ): string {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $counter = 1;

        $query = $modelClass::query()->where($slugColumn, $slug);
        if ($ignoreId) {
            $query->where($idColumn, '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter++;
            $query = $modelClass::query()->where($slugColumn, $slug);
            if ($ignoreId) {
                $query->where($idColumn, '!=', $ignoreId);
            }
        }

        return $slug;
    }
}
