<?php

namespace App\Models;

use App\Helpers\DB;

class Industry
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM industries ORDER BY `order` ASC, `name` ASC");
    }

    public static function published(): array
    {
        return DB::select("SELECT * FROM industries WHERE is_published = 1 ORDER BY `order` ASC, `name` ASC");
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM industries WHERE id = :id", ['id' => $id]);
    }
}
