<?php

namespace App\Models;

use App\Helpers\DB;

class LegalPage
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM legal_pages ORDER BY `title` ASC");
    }

    public static function published(): array
    {
        return DB::select("SELECT * FROM legal_pages WHERE is_published = 1 ORDER BY `title` ASC");
    }

    public static function findBySlug(string $slug): ?array
    {
        return DB::selectOne("SELECT * FROM legal_pages WHERE slug = :slug AND is_published = 1", ['slug' => $slug]);
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM legal_pages WHERE id = :id", ['id' => $id]);
    }
}
