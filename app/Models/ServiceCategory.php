<?php

namespace App\Models;

use App\Helpers\DB;

class ServiceCategory
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM service_categories ORDER BY `order` ASC, `name` ASC");
    }

    public static function published(): array
    {
        return DB::select("SELECT * FROM service_categories WHERE is_published = 1 ORDER BY `order` ASC, `name` ASC");
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM service_categories WHERE id = :id", ['id' => $id]);
    }
}
