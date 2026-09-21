<?php

namespace App\Models;

use App\Helpers\DB;

class Faq
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM faqs ORDER BY `order` ASC, `id` DESC");
    }

    public static function published(int $limit = null): array
    {
        $limitClause = $limit !== null ? "LIMIT " . (int)$limit : "";
        return DB::select("SELECT * FROM faqs WHERE is_published = 1 ORDER BY `order` ASC, `id` DESC $limitClause");
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM faqs WHERE id = :id", ['id' => $id]);
    }
}
